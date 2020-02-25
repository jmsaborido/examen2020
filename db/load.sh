#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U biblio -d biblio < $BASE_DIR/biblio.sql
fi
psql -h localhost -U biblio -d biblio_test < $BASE_DIR/biblio.sql
