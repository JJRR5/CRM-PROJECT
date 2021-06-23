import mysql.connector as mysqldb
import time
import os 
import RPi.GPIO as GPIO1
import gpiozero
GPIO1.setmode(GPIO1.BCM)
GPIO1.setwarnings(False)
#CONFIGURATION
try:
    while True:
        conn = mysqldb.connect(host='localhost',user='JJRR_JAAA_69523_68530',password = 'proyecto_final',database="DB_Proyecto_2021_JJRR_JAAA")
        cursor = conn.cursor() 
        query= "select GPIO,TIPO,ESTADO from GPIO_69523_68530"
        cursor.execute(query) 
        for GPIO,TIPO,ESTADO in cursor.fetchall():
            print("GPIO: ",int(GPIO))
            print("TIPO: "+str(TIPO))
            print("ESTADO: "+str(ESTADO))
            if TIPO == "Salida" and ESTADO == "ENCENDIDO":
                GPIO1.setup(int(GPIO),GPIO1.OUT)
                GPIO1.output(int(GPIO),GPIO1.HIGH)
            elif TIPO == "Salida" and ESTADO == "APAGADO":
                GPIO1.setup(int(GPIO),GPIO1.OUT)
                GPIO1.output(int(GPIO),GPIO1.LOW)
            elif TIPO == "Entrada":
                GPIO1.setup(int(GPIO),GPIO1.IN)
                if GPIO1.input(int(GPIO)):
                    query = ("update GPIO_69523_68530 SET ESTADO = 'Cerrado' WHERE GPIO = '"+str(GPIO)+"'")
                    cursor.execute(query)
                else: 
                    query = ("update GPIO_69523_68530 SET ESTADO = 'Abierto' WHERE GPIO = '"+str(GPIO)+"'")
                    cursor.execute(query)
            elif TIPO == "PWM":
                pwm = gpiozero.PWMLED(int(GPIO)) 
                if GPIO:
                    porcentaje = int(ESTADO)/100
                    pwm.value = porcentaje
                    time.sleep(1)
                else:
                    pwm=0
        pwm=0
        cursor.close()
        conn.commit()
        conn.close()
except KeyboardInterrupt:
    print("BYE")
    GPIO1.cleanup(int(GPIO))