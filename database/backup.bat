copy database.sqlite backups\database.sqlite

cd backups

ren "database.sqlite" "databaseBackup%Date:/=-%.sqlite"