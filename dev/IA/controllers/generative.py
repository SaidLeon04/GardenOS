import web
from models.generative import ObtenerValoresOptimos

modelo = ObtenerValoresOptimos(host='localhost', user='root', database='testgardenos')

render = web.template.render('views/')

class Generative:
    def GET(self, key):
        try:
            resultado = modelo.obtener_valores(key)
            return render.index(resultado, key)
        except Exception as e:
            print(f"Error - Generative.GET(): {str(e)}")
            return "Error al procesar la solicitud."
        
