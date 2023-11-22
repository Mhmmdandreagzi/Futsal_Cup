
from flask import Flask, render_template, request, url_for, flash, redirect, jsonify, make_response
from lib import database, dd

from models import MasterPemain, MasterTim
import appConfig
app = Flask(__name__)
app.config.from_object('appConfig')
database.init_app(app)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/scan-qr')
def scanQr():
    return render_template('scan-page.html')   

@app.route('/checkScan',methods=['POST'])
def checkScan():
    data = request.form['code']
    code = MasterTim.checkQr(data)
    if not code :
        resp = {'code': 401, 'success': False, 'message': 'Data not found'}
        return jsonify({'metadata': resp})
    else : 
        resp = {'code': 200, 'success': True, 'message': 'success'}
        return jsonify({'metadata': resp, 'response': data})  
    
@app.route('/dataPemain/<string:code>',methods=['GET'])    
def dataPemain(code):
    dataTim = MasterTim.getTim(code)
    dataPemain = MasterPemain.getDataPemain(dataTim[0]['idmsttim'])
    return render_template('dataPemain.html',dataTim = dataTim, dataPemain = dataPemain)

if __name__ == '__main__':
    app.secret_key = appConfig.SECRET_KEY
    app.run(debug=True)