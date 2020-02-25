#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE biblio_test;"
    psql -U postgres -c "CREATE USER biblio PASSWORD 'biblio' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists biblio
    sudo -u postgres dropdb --if-exists biblio_test
    sudo -u postgres dropuser --if-exists biblio
    sudo -u postgres psql -c "CREATE USER biblio PASSWORD 'biblio' SUPERUSER;"
    sudo -u postgres createdb -O biblio biblio
    sudo -u postgres psql -d biblio -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O biblio biblio_test
    sudo -u postgres psql -d biblio_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:biblio:biblio"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
