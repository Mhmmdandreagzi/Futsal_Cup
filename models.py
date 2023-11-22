from lib import dd
from lib.database import sa 

class MasterTim(sa.Model):
    __tablename__ = 'msttim'

    idmsttim = sa.Column(sa.Integer, primary_key = True)
    code_tim = sa.Column(sa.String(12))
    nama_tim = sa.Column(sa.String(150))
    nama_official = sa.Column(sa.String(45))
    no_official = sa.Column(sa.Integer)

    def getTim(code) :
        data = []
        q = MasterTim.query.filter(MasterTim.code_tim == code).one_or_none()

        if not q:
            data=[]
        else:
            data.append({
                'idmsttim' : q.idmsttim,
                'code_tim' : q.code_tim,
                'nama_tim' : q.nama_tim,
                'nama_official' : q.nama_official,
                'no_official' : q.no_official
           })
            
        return data    

    
    def checkQr(data):
        data1 = MasterTim.query.filter(MasterTim.code_tim == data).one_or_none()
        return data1
    


class MasterPemain(sa.Model):
    __tablename__ = 'mstpemain'

    idpemain = sa.Column(sa.Integer, primary_key = True)
    idmsttim = sa.Column(sa.Integer)
    nama_pemain = sa.Column(sa.String(45))
    no_punggung = sa.Column(sa.Integer)
    path_foto = sa.Column(sa.String(45))  
    path_sk = sa.Column(sa.String(45))  

    def getDataPemain(idtim):
        q = MasterPemain.query.filter(MasterPemain.idmsttim == idtim).all()
        data=[]
        for pemain in q:
            data.append({
                'idpemain' : pemain.idpemain,
                'idmsttim' : pemain.idmsttim,
                'nama_pemain' : pemain.nama_pemain,
                'no_punggung' : pemain.no_punggung,
                'path_foto' : pemain.path_foto,
                'path_sk' : pemain.path_sk,
           })
        return data    
