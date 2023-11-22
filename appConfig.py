import os
basedir = os.path.abspath(os.path.dirname(__file__))

MYSQL_USER = 'root'
MYSQL_PASSWORD = '4ndr3'
MYSQL_HOST = '127.0.0.1'
MYSQL_DB = 'rsudma_cup'
SECRET_KEY = 'screet'

SQLALCHEMY_TRACK_MODIFICATIONS = False
SQLALCHEMY_DATABASE_URI = "mysql://"+MYSQL_USER+":"+MYSQL_PASSWORD+"@"+MYSQL_HOST+"/"+MYSQL_DB