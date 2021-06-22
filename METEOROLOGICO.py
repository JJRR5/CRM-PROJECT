import mysql.connector as mysqldb
import smbus2
import bme280
import datetime
import time
import sys 
conn = mysqldb.connect(host='localhost',user='JJRR_JAAA_69523_68530',password = 'proyecto_final',database="DB_Proyecto_2021_JJRR_JAAA")
cursor = conn.cursor() 
port = 1
address = 0x76
bus = smbus2.SMBus(port)

'''calibration_params = bme280.load_calibration_params(bus, address)
data = bme280.sample(bus, address, calibration_params)'''
try:
    TEMPERATURA1= "36"
    PRESION1="800"
    HUMEDAD1="40"
    ahora = datetime.datetime.now()
    HORA = str(ahora.strftime('%H:%M:%S'))
    FECHA = str(ahora.strftime('%Y/%m/%d'))
    ID=str(sys.argv[1])
    query= "insert into METEOROLOGICO_69523_68530 (ID,PRESION,TEMPERATURA,HUMEDAD,FECHA,HORA) values ('"+ID+"',900,40,50,'"+FECHA+"','"+HORA+"')"
    cursor.execute(query)
    print("<br> CONSULTA REALIZADA, INGRESA A LA BASE DE DATOS PARA VER LOS CAMBIOS </br>")
    '''
    TEMPERATURA =int(data.temperature)
    PRESION=int(data.pressure)
    HUMEDAD= int(data.humidity)
    TEMPERATURA1 =str(TEMPERATURA)
    PRESION1=str(PRESION)
    HUMEDAD1= str(HUMEDAD)'''
except:
    print("<br> ALGO SALIO MAL EN PYTHON </br>")
    
cursor.close()
conn.commit()
conn.close()