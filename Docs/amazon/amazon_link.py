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
    ['https://www.amazon.com/s?k=Body+Skin+Care+Products&i=beauty&rh=n%3A11060521&page=','body_care_products'],
    ['https://www.amazon.com/Beauty-Devices/s?k=Beauty+Devices&page=','beauty_devices'],
    ['https://www.amazon.com/hair-products/s?k=hair+products&page=','hair_care_products'],
    ['https://www.amazon.com/skin-care-products/s?k=skin+care+products&page=','face_care'],
    ['https://www.amazon.com/makeup-products/s?k=makeup+products&page=','cosmetics_products'],
    ['https://www.amazon.com/s?k=sports+clothes+for+girls&page=','beauty_sports']
]


list_links=[]
for i in range(0,len(url_list)):
    category=url_list[i][1]

    for j in range(1,6):
        cp=0
        url=str(url_list[i][0])+str(j)
        print(url)

        while(cp!=2):
            try:

                driver=webdriver.Chrome()
                driver.set_window_position(-10000,0)
                driver.get(str(url))

                links_sections=driver.find_elements(By.CLASS_NAME,'s-title-instructions-style')
                for x in links_sections:
                    link=x.find_element(By.TAG_NAME,'a').get_attribute('href')
                    if(link.strip()!='javascript:void(0)'):
                        list_links.append(str(link))
                for l in list_links:
                    print(l)
                cp=2
            except Exception as e:
                cp+=1
                driver.close
   
    with open(f'Docs/amazon/excel/amazon_link_{category}.csv',mode='w',newline='',encoding='utf') as filec:
        writer=csv.writer(filec)
        for x in list_links:
            writer.writerow([x])  
      
