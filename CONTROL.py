import mysql.connector as mysqldb
import time
import os 
import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
#CONFIGURATION



conn = mysqldb.connect(host='localhost',user='JJRR_JAAA_69523_68530',password = 'proyecto_final',database="DB_Proyecto_2021_JJRR_JAAA")
cursor = conn.cursor() 
try:
    while True:
        query= "select GPIO,TIPO,ESTADO from GPIO_69523_68530"
        cursor.execute(query) 
        #result = cursor.fetchall()
        for registro in cursor:
            print("GPIO " +str(registro))
            gpio = int(registro[0][0])
            if registro[1][0] == "S" and registro[2][0]== "E":
                GPIO.setup(gpio,GPIO.OUT)
                GPIO.output(gpio,GPIO.HIGH)
                print ("Si entro ")
            elif registro[1][0] == "S" and registro[2][0]== "A":
                GPIO.setup(gpio,GPIO.OUT)
                GPIO.output(gpio,GPIO.LOW)
                print ("Si entro a")
        print(registro[2][0])
        print("//////////////////////////")
        time.sleep(1)
except KeyboardInterrupt:
    print("BYE")
    GPIO.cleanup(17)
cursor.close()
conn.commit()
conn.close()