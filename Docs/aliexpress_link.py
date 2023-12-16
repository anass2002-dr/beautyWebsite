import schedule
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import csv
import json
import requests
import os

# links_list=[]

url_list=[
    ['https://www.aliexpress.com/w/wholesale-body-care-products.html?page=&g=y&SearchText=body+care+products','body_care_products'],
    ['https://www.aliexpress.com/w/wholesale-beauty-device.html?page=&g=y&SearchText=beauty+device','beauty_devices'],
    ['https://www.aliexpress.com/w/wholesale-hair-care-products.html?page=&g=y&SearchText=hair+care+products','hair_care_products'],
    ['https://www.aliexpress.com/w/wholesale-best-skin-care.html?page=&g=y&SearchText=best+skin+care','face_care'],
    ['https://www.aliexpress.com/w/wholesale-cosmetics-products.html?page=&g=y&SearchText=cosmetics+products','cosmetics_products'],
    ['https://www.aliexpress.com/w/wholesale-beauti-sport.html?page=&g=y&SearchText=beauti+sport','beauty_sports']
]


for i in range(0,len(url_list)):
    category=url_list[i][1]
    url=url_list[i][0].split('page=')
    list_links=[]
    for i in range(1,6):
        newurl=f'{url[0]}page={i}{url[1]}'
        cp=0
        print(newurl)

        while(cp!=2):
            driver=webdriver.Chrome()
            driver.set_window_position(-10000,0)
            driver.get(newurl)
            # print(url)

            try:
                links=driver.find_elements(By.CLASS_NAME,'multi--container--1UZxxHY')
                for x in links:
                    list_links.append(str(x.get_attribute('href')))
                for l in list_links:
                    print(l)
                cp=2
            except Exception as e:
                cp+=1
                driver.close
   
    with open(f'Docs/excel/aliexpres_link_{category}.csv',mode='w',newline='',encoding='utf') as filec:
        writer=csv.writer(filec)
        for x in list_links:
            writer.writerow([x])  
      
