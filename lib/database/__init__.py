from flask_sqlalchemy import SQLAlchemy

sa = SQLAlchemy()


def init_app(app):
    sa.init_app(app)