"""Read workbook values without executing formulas or embedded instructions."""
import collections
import datetime
import decimal
import hashlib
import json
from pathlib import Path
import sys
import xml.etree.ElementTree as ET
import zipfile

source = Path(sys.argv[1])
output = Path(sys.argv[2])
ns = {'s': 'http://schemas.openxmlformats.org/spreadsheetml/2006/main'}
transactions, issues, warnings = [], [], []
with zipfile.ZipFile(source) as archive:
    strings = [''.join(node.itertext()) for node in ET.fromstring(archive.read('xl/sharedStrings.xml')).findall('s:si', ns)]
    sheet = ET.fromstring(archive.read('xl/worksheets/sheet1.xml'))
    for row in sheet.findall('s:sheetData/s:row', ns):
        number = int(row.get('r'))
        if number < 5:
            continue
        cells = {}
        for cell in row.findall('s:c', ns):
            column = cell.get('r').rstrip('0123456789')
            if column not in ('B', 'C', 'D', 'E', 'F'):
                continue
            value = cell.find('s:v', ns)
            if value is not None:
                cells[column] = strings[int(value.text)] if cell.get('t') == 's' else value.text
        if not any(cells.get(key) for key in ('C', 'D', 'E', 'F')):
            continue
        code = (cells.get('C') or '').strip().upper()
        description = (cells.get('D') or '').strip()
        amounts = []
        try:
            for column, direction in [('E', 'pemasukan'), ('F', 'pengeluaran')]:
                amount = decimal.Decimal((cells.get(column) or '').strip() or '0').quantize(decimal.Decimal('0.01'))
                if amount < 0:
                    raise ValueError('Nominal negatif perlu diperiksa')
                if amount:
                    amounts.append((direction, str(amount)))
            if not amounts:
                raise ValueError('Nominal kosong/nol')
            date = (datetime.datetime(1899, 12, 30) + datetime.timedelta(days=float(cells['B']))).date().isoformat()
            if not description:
                description = 'Keterangan kosong di Excel — perlu diperiksa'
                warnings.append({'row': number, 'reason': 'Keterangan kosong'})
        except (ValueError, KeyError, decimal.InvalidOperation) as error:
            issues.append({'row': number, 'reason': str(error), 'cells': cells})
            continue
        for direction, amount in amounts:
            transactions.append({'row': number, 'date': date, 'code': code, 'description': description, 'type': direction, 'amount': amount})

result = {'file': source.name, 'sheet': 'KAS 2026', 'sha256': hashlib.sha256(source.read_bytes()).hexdigest(), 'transactions': transactions, 'issues': issues, 'warnings': warnings}
output.parent.mkdir(parents=True, exist_ok=True)
output.write_text(json.dumps(result, ensure_ascii=False, indent=2), encoding='utf-8')
print(json.dumps({'transactions': len(transactions), 'issues': issues, 'codes': dict(collections.Counter(item['code'] for item in transactions)), 'date_min': min(item['date'] for item in transactions), 'date_max': max(item['date'] for item in transactions), 'totals': {kind: str(sum(decimal.Decimal(item['amount']) for item in transactions if item['type'] == kind)) for kind in ('pemasukan', 'pengeluaran')}}, ensure_ascii=False, indent=2))
