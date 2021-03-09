# Aplikasi E-Report Polda Kalbar
## Asset:
- [File Resource](https://drive.google.com/drive/folders/1K6BHuxMQ5H5u1CwVjzY1OTfveWZ6o72F)
- [Mockup](https://www.figma.com/file/BlTxSDXAcFwd6LpfVaO88G/E-REPORT-POLDA-KALBAR-REV?node-id=0%3A1)

## Backup Database
```sh
docker exec mysql.server /usr/bin/mysqldump -u root --password=root dbweb_ereport > assets/database.sql
```

## Restore Database
```sh
cat assets/database.sql | docker exec -i mysql.server /usr/bin/mysql -u root --password=root dbweb_ereport
```