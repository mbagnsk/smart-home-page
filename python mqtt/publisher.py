import paho.mqtt.client as mqtt
import random as rand
import time
import sys
import datetime

topic = sys.argv[1]

client = mqtt.Client()
client.connect("192.168.1.42", 1883, 60)

while True:
    value = 'value'
    client.publish(topic, value)

    # print(value)
    time.sleep(2)

client.disconnect()