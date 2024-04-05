import web
import google.generativeai as genai

urls = (
    '/(.*)', 'controllers.generative.Generative',
)

app = web.application(urls, globals())

if __name__ == "__main__":
    web.httpserver.runsimple(app.wsgifunc(), ('127.0.0.1', 8081))