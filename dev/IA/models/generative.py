import mysql.connector
import google.generativeai as genai

# IA Stuff
genai.configure(api_key="AIzaSyDLzvnrcjUvkXtmrei5AwPHLp6IucRmddI")

generation_config = {
  "temperature": 1,
  "top_p": 1,
  "top_k": 1,
  "max_output_tokens": 2048,
}

safety_settings = [
  {
    "category": "HARM_CATEGORY_HARASSMENT",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
  {
    "category": "HARM_CATEGORY_HATE_SPEECH",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
  {
    "category": "HARM_CATEGORY_SEXUALLY_EXPLICIT",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
  {
    "category": "HARM_CATEGORY_DANGEROUS_CONTENT",
    "threshold": "BLOCK_MEDIUM_AND_ABOVE"
  },
]

model = genai.GenerativeModel(model_name="gemini-1.0-pro",
                              generation_config=generation_config,
                              safety_settings=safety_settings)

class ObtenerValoresOptimos:
    def __init__(self, host, user, database):
        self.host = host
        self.user = user
        self.database = database

    def obtener_valores(self, nombre_lote):
        try:
            conn = mysql.connector.connect(
                host=self.host,
                user=self.user,
                database=self.database
            )
            cursor = conn.cursor()

            cursor.execute("SELECT id_lote, id_planta, fecha_inicial, cantidad_actual, estado FROM lote WHERE nombre_lote = %s", (nombre_lote,))
            lote = cursor.fetchone()

            if lote:
                id_lote, id_planta, fecha_inicial, cantidad_actual, estado = map(str, lote)
                
                cursor.execute("SELECT nombre FROM plantas WHERE id_planta = %s", (id_planta,))
                planta = cursor.fetchone()
                if planta:
                    nombre_planta = planta[0]

                    cursor.execute("SELECT humedad FROM humedad WHERE id_lote = %s", (id_lote,))
                    humedad = cursor.fetchall()
                    print(humedad)
                    if humedad:
                        humedad = [h[0] for h in humedad if h[0] is not None]
                        if humedad: 
                          humedad_promedio = sum(humedad) / len(humedad)
                          humedad_promedio = round(humedad_promedio, 2)
                          humedad_promedio = str(humedad_promedio)

                        cursor.execute("SELECT temperatura FROM temperatura WHERE id_lote = %s", (id_lote,))
                        temperatura = cursor.fetchall()
                        if temperatura: 
                            temperatura = [h[0] for h in temperatura if h[0] is not None]  # Filtrar valores None
                            if temperatura:
                                temperatura_promedio = sum(temperatura) / len(temperatura)
                                temperatura_promedio = round(temperatura_promedio, 2)
                                temperatura_promedio = str(temperatura_promedio)

                            cursor.execute(f"SELECT COUNT(*) FROM riego WHERE id_lote = {id_lote}")
                            riegos = cursor.fetchone()
                            riegos = riegos[0]
                            riegos = str(riegos)

                            # valores enviados:
                            # id_lote, id_planta, fecha_inicial, cantidad_actual, nombre_planta, humedad_promedio, temperatura_promedio, riegos
                            prompt_parts = [
                                "input: Nombre: Girasoles\nHumedad promedio: 65\nTemperatura promedio: 24\nProceso actual: germinacion\nCantidad semillas: 100\nDías: 20\nDias Riego: 15",
                                "output: La humedad promedio del 65% se encuentra dentro del rango óptimo para la germinación de los girasoles, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 24°C se encuentra dentro del rango óptimo para la germinación de los girasoles, que oscila entre 20°C y 30°C.\n\nLa mayoría de las semillas de girasol germinan entre 4 y 10 días, aunque algunas pueden tardar más.\n\nEs importante verificar el estado del suelo antes de regar, asegurándose de que esté ligeramente húmedo pero no encharcado.",
                                "input: Nombre: Fresas\nHumedad Promedio: 64\nTemperatura_promedio:17\nDias:20\nDias Riego: 15\nProceso Actual: germinación\nCantidad Semillas: 100",
                                "output: La humedad promedio del 64% se encuentra por debajo del rango óptimo para la germinación de las fresas, que oscila entre el 70% y el 80%.\n\nProteger las semillas de las temperaturas nocturnas frías.\n\nRegar las semillas cada 2 o 3 días para mantener el suelo húmedo pero no encharcado.\n\nEvitar la exposición directa al sol durante las horas más calurosas del día.\n\nLa germinación de las fresas puede tardar hasta 20 días.",
                                "input: Nombre: Aguacate\nHumedad Promedio: 76\nTemperatura promedio: 25\nDias:12\nDias Riego: 12\nProceso Actual: germinación\nCantidad Semillas: 86",
                                "output: Mantén la humedad del suelo entre el 28% y el 55% para la germinación del aguacate. Reduce el riego.\n\nRiega las semillas cada día o cuando el suelo esté ligeramente seco al tacto.\n\nEvita regar en exceso las semillas, ya que esto puede pudrirlas.\n\nColoca las semillas en un lugar cálido y soleado. La temperatura ideal para la germinación es entre 20°C y 25°C.\n\nTen paciencia. La germinación del aguacate puede tardar hasta 6 semanas.",
                                "input: Nombre: Lavanda\nHumedad Promedio: 43\nTemperatura promedio: 27\nDias:6\nDias Riego: 3\nProceso Actual: germinación\nCantidad Semillas: 10",
                                "output: La humedad promedio del 50% se encuentra por debajo del rango óptimo para la germinación de la lavanda, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 25°C se encuentra dentro del rango óptimo para la germinación de la lavanda, que oscila entre los 15°C y los 30°C.\n\nLa mayoría de las semillas de lavanda germinan entre 10 y 20 días, aunque algunas pueden tardar más.\n\nRegar las semillas cada 2 días para mantener el suelo húmedo pero no encharcado.",
                                "input: Nombre: Eucalipto\nHumedad promedio: 23%\nTemperatura promedio: 10°C\nDías: 40\nDías de riego: 25\nProceso actual: Siembra\nCantidad de semillas: 281",
                                "output: La humedad promedio del 23% se encuentra muy por debajo del rango óptimo para la siembra del eucalipto, que oscila entre el 70% y el 80%.\n\nLa temperatura promedio de 10°C se encuentra por debajo del rango óptimo para la siembra del eucalipto, que oscila entre 18°C y 25°C.\n\nEs recomendable regar las semillas cada 2 o 3 días \npara mantener el suelo húmedo pero no encharcado.",
                                "input: Nombre: Orquídea\nHumedad Promedio: 70%\nTemperatura Promedio: 25°C\nDías: 60\nDías Riego: 15\nProceso Actual: siembra\nCantidad de Plantas: 5",
                                "output: La humedad promedio del 70% se encuentra dentro del rango óptimo para la siembra de orquídeas, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 25°C se encuentra dentro del rango óptimo para la siembra de orquídeas, que oscila entre 20°C y 30°C.\n\nEs recomendable regar las plantas cada 7 a 10 días o cuando el sustrato esté ligeramente seco al tacto.",
                                "input: Nombre: Aloe vera\nHumedad promedio: 40%\nTemperatura promedio: 22°C\nDías: 60\nDías de riego: 30\nProceso actual: Crecimiento\nCantidad de plantas: 12",
                                "output: La humedad promedio del 40% se encuentra por debajo del rango óptimo para el crecimiento del Aloe vera, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 22°C se encuentra dentro del rango óptimo para el crecimiento del Aloe vera, que oscila entre 18°C y 27°C.\n\nEs importante observar el crecimiento de las plantas para determinar si necesitan ser trasplantadas a macetas más grandes.\n\nRegar las plantas cada 2 días puede ser una frecuencia insuficiente para mantener la humedad adecuada del suelo durante el crecimiento, especialmente en climas secos.",
                                "input: Nombre: Rosa\nHumedad Promedio: 65%\nTemperatura Promedio: 22°C\nDías: 60\nDías Riego: 20\nProceso Actual: Crecimiento\nCantidad de Plantas: 12",
                                "output: La humedad promedio del 65% se encuentra dentro del rango óptimo para el crecimiento de las rosas, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 22°C se encuentra dentro del rango óptimo para el crecimiento de las rosas, que oscila entre 18°C y 27°C.\n\nEs importante observar el crecimiento de las plantas para determinar si necesitan ser podadas o trasplantadas a entornos más grandes.\n\nEs recomendable regar las plantas cuando el suelo esté ligeramente seco al tacto.\nEs importante evitar el exceso de riego, ya que puede pudrir las raíces.",
                                "input: Nombre: Jazmín\nHumedad promedio: 12%\nTemperatura promedio: 5°C\nDías: 29\nDías de riego: 20\nProceso actual: Crecimiento\nCantidad de plantas: 120",
                                "output: La humedad promedio del 12% se encuentra muy por debajo del rango óptimo para el crecimiento del jazmín, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 5°C se encuentra por debajo del rango óptimo para el crecimiento del jazmín, que oscila entre 15°C y 25°C.\n\nEs importante observar el crecimiento de las plantas para determinar si necesitan ser trasplantadas a macetas más grandes.\n\nEs recomendable regar las plantas cada 3 a 5 días o cuando el suelo esté seco al tacto.\n\nEvitar la exposición directa al sol durante las horas más calurosas del día.\n\nFertilizar las plantas cada 2 o 3 meses con un fertilizante específico para jazmín.",
                                "input: Nombre: Mango\nHumedad Promedio: 70%\nTemperatura Promedio: 28°C\nDías: 90\nDías Riego: 20\nProceso Actual: Crecimiento\nCantidad de Plantas: 15",
                                "output: La humedad promedio del 70% se encuentra dentro del rango óptimo para el crecimiento del mango, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 28°C se encuentra dentro del rango óptimo para el crecimiento del mango, que oscila entre 20°C y 30°C.\n\nEs importante observar el crecimiento de las plantas para determinar si necesitan ser podadas o trasplantadas a entornos más grandes.\n\nRegar las plantas cada 2 o 3 días puede ser una frecuencia insuficiente para mantener la humedad adecuada del suelo durante el crecimiento, especialmente en climas secos.",
                                "input: Nombre: Naranja\nHumedad Promedio: 65%\nTemperatura Promedio: 22°C\nDías: 180\nDías Riego: 25\nProceso Actual: germinacion\nCantidad de Plantas: 8",
                                "output: La humedad promedio del 65% se encuentra dentro del rango óptimo para la germinación de la naranja, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 22°C se encuentra dentro del rango óptimo para la germinación de la naranja, que oscila entre 20°C y 25°C.\n\nLa mayoría de las semillas de naranja germinan entre 30 y 45 días, aunque algunas pueden tardar más.\n\nRegar las semillas cada 2 o 3 días para mantener el suelo húmedo pero no encharcado.",
                                "input: Nombre: Tulipán\nHumedad promedio: 32%\nTemperatura promedio: 15°C\nDías: 45\nDías de riego: 30\nProceso actual: Cosecha\nCantidad de plantas: 15",
                                "output: La humedad promedio del 32% se encuentra por debajo del rango óptimo para la cosecha de tulipanes, que oscila entre el 60% y el 80%.\n\nLa temperatura promedio de 15°C se encuentra dentro del rango óptimo para la cosecha de tulipanes, que oscila entre 10°C y 20°C.\n\nRegar las plantas durante 30 de 60 días puede ser una frecuencia insuficiente para mantener la humedad adecuada del suelo durante la cosecha.\n\nPara cosechar asegurate que: \nLos capullos de las flores están completamente desarrollados y comienzan a abrirse.\nEl color de los pétalos es intenso y uniforme.\nLos tallos están firmes y erguidos.",
                                "input: Nombre: Plátano\nHumedad promedio: 75%\nTemperatura promedio: 25°C\nDías: 200\nDías de riego: 174\nProceso actual: Cosecha\nCantidad de plantas: 90",
                                "output: La humedad promedio del 75% se encuentra dentro del rango óptimo para la cosecha de plátano, que oscila entre el 70% y el 80%.\nEs importante mantener la humedad del ambiente para evitar que los plátanos se deshidraten y pierdan calidad.\n\nLa temperatura promedio de 25°C se encuentra dentro del rango óptimo para la cosecha de plátano, que oscila entre 20°C y 30°C.\n\nEs recomendable regar las plantas cada 10 a 15 días o cuando el suelo esté seco al tacto.\n\nObservar el desarrollo de los plátanos para determinar el momento óptimo de la cosecha.\nLa creencia popular indica que cortar los plátanos por la mañana es ideal, cuando estén completamente maduros.",
                                "input: Nombre: Lirio\nHumedad Promedio: 20%\nTemperatura Promedio: -2°C\nDías: 60\nDías Riego: 20\nProceso Actual: Cosecha\nCantidad de Plantas: 4",
                                "output: La humedad promedio del 20% se encuentra muy por debajo del rango óptimo para la cosecha de lirios, que oscila entre el 60% y el 80%.\nEs fundamental aumentar la humedad del ambiente de forma considerable para que las flores puedan mantener su calidad durante la cosecha.\n\nLa temperatura promedio de -2°C se encuentra muy por debajo del rango óptimo para la cosecha de lirios, que oscila entre 10°C y 25°C.",
                                "input: Nombre:" + nombre_planta + "\nHumedad Promedio:" + humedad_promedio + "\nTemperatura Promedio:" + temperatura_promedio + "\nDías: 12 \nDías Riego:" + riegos + "\nProceso Actual:" + estado + "\nCantidad de Plantas: " + cantidad_actual+ ","
                                "output: ",
                                ]

                            resultado = model.generate_content(prompt_parts)
                            print(resultado.text)
                            return resultado.text
                    else:
                        return None
                else:
                    return None                
            else:
                return None
        except mysql.connector.Error as e:
            print(f"Error - ObtenerValoresOptimos().obtener_valores(): {e}")
            return None
        finally:
            if 'conn' in locals() and conn.is_connected():
                cursor.close()
                conn.close()

"""
modelo = ObtenerValoresOptimos(host='localhost',
                           user='root',
                           database='testgardenos')

resultado = modelo.obtener_valores(nombre_lote="flores lunares :o")


if resultado:
    id_lote, id_planta, fecha_inicial, cantidad_actual, nombre_planta, humedad_promedio, temperatura_promedio, riegos = resultado

    print(f"ID del lote: {id_lote}")
    print(f"ID de la planta: {id_planta}")
    print(f"Fecha inicial: {fecha_inicial}")
    print(f"Cantidad actual: {cantidad_actual}")
    print(f"Nombre de la planta: {nombre_planta}")
    print(f"Humedad promedio: {humedad_promedio}")
    print(f"Temperatura promedio: {temperatura_promedio}")
    print(f"Número de riegos: {riegos}")

"""