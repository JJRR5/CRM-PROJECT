import time
import max30100
import mysql.connector as mysqldb
import sys
conn = mysqldb.connect(host='localhost',user='JJRR_JAAA_69523_68530',password = 'proyecto_final',database="DB_Proyecto_2021_JJRR_JAAA")
cursor = conn.cursor() 
try:
    paciente =str(sys.argv[1])
    mx30 = max30100.MAX30100()
    mx30.enable_spo2()
    mx30.read_sensor()
    mx30.ir, mx30.red
    spo2 = int(mx30.ir / 100)
    if mx30.ir != mx30.buffer_ir :
        print("SPO2:",spo2)
    spo2_crack=str(spo2)
    query= "update PACIENTES_69523_68530 set SPO2='"+spo2_crack+"' where PACIENTE = '"+paciente+"'"
    print(spo2)
    cursor.execute(query)
    cursor.close()
    conn.commit()
    conn.close()
except:
    print("NO PACIENTE,NO CODIGO")