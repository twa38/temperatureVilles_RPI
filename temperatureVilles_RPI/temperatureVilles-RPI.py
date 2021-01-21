# coding: UTF-8
"""
Script: pythonProjectSQL/testSQL
Création: twarnier, le 18/12/2020
"""

# Imports
import sqlite3
import requests

# Fonctions

def set_temperature_bdd(temperature, ville):
    cnx = sqlite3.connect('temperatureVilles.sqlite')
    update_temperature = "UPDATE temperatureVilles SET temperature = ?, last_update = datetime('now') WHERE ville = ?"
    data_temperature = (temperature, ville)
    c = cnx.cursor()
    c.execute(update_temperature,data_temperature)
    cnx.commit()
    c.close()
    cnx.close()

def get_temperature(ville):
    url = "http://api.openweathermap.org/data/2.5/weather?q="+ville+",fr&units=metric&lang=fr&appid=0a73790ec47f53b9e1f2e33088a0f7d0"
    return float(requests.get(url).json()['main']['temp'])
    c.close()
    cnx.close()

# Programme principal
def main():
    set_temperature_bdd(-6.8,'meylan')

    listeVilles = ['grenoble', 'meylan', 'lyon']
    for ville in listeVilles:
        temperature = get_temperature(ville)
        print('Température à ', ville, ' : ', temperature, '°')
        set_temperature_bdd(temperature, ville)

if __name__ == '__main__':
    main()
# Fin
