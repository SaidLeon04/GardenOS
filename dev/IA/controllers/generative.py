import web
from models.generative import ObtenerValoresOptimos

modelo = ObtenerValoresOptimos(host='localhost', user='root', database='testgardenos')

render = web.template.render('views/')

class Generative:
    def GET(self, nombre_lote="flores lunares :o"):
        try:
            resultado = modelo.obtener_valores(nombre_lote)
            return render.index(resultado)
        except Exception as e:
            print(f"Error - Generative.GET(): {str(e)}")
            return "Error al procesar la solicitud."
        
