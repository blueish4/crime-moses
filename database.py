#Main database

#Input: Location, Datetime, Route, Crimes

import mySQLdb



import sys

try:
    con = MySQLdb.connect(host="136.68.141.107", port=22, user="root", passwd="django-m0ses", db="crimemoses");

    cur = con.cursor()
    cur.execute("SELECT VERSION()")

    ver = cur.fetchone()

    print
    "Database version : %s " % ver

except mdb.Error, e:

    print
    "Error %d: %s" % (e.args[0], e.args[1])
    sys.exit(1)

finally:

    if con:
        con.close()

