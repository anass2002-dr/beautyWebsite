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
from datetime import date
path="C:\\Program Files (x86)\\chromedriver.exe"
cp=0

cats=[
    'body_care_products',
    'beauty_sports',
    'hair_care_products',
    'face_care',
    'cosmetics_products',
    'beauty_devices'
]

#  Body care
#  BEAUTY AND SPORT
#  HAIRCARE PRODUCTS
#  FACE CARE
#  COSMETICS AND MAKEUP
#  BEAUTY DEVICES
last_id=295
for i in range(3,4):
    links_list=[]

    with open(f'Docs/excel/aliexpres_link_{cats[i-1]}.csv','r',encoding='utf8') as filecsv:
        csv_reader = csv.reader(filecsv, delimiter=',')
        for ff in csv_reader:
            links_list.append(ff)
    print(cats[i-1])
    query="INSERT INTO `product` (`PRODUCT_ID`,`TITLE`, `CATEGORY_ID`, `PHOTO`, `VIDEO`, `PRODUCT_LINK`, `CONTENT`, `PRODUCT_SHORT`, `PRODUCT_PRICE`, `SPONSOR_ID`,`DDP`, `CREATED_DATE`, `UPDATE_DATE`) values"
    collection_query="INSERT INTO `product_collection_photos`(`PRODUCT_ID`, `PHOTO_PATH`, `UPDATE_DATE`) VALUES"
    new_link_list=[]
    for link in links_list:
        for x in link:
            y=x.split('?')
            new_link_list.append(y[0])
    id=0
    if last_id==0:
        id=1
    else:
        id=last_id
    reste=len(new_link_list)
    for j in range(0,len(new_link_list)):
        print(f'the rest is of link is : {reste}')
        err=0
        url=str(new_link_list[j])
        
        print(url)
        while(err!=2):
            try:
                driver=webdriver.Chrome()
                driver.set_window_position(-10000,0)
                driver.get(str(url))
                
                page_title=driver.title
                if(page_title!='Page Not Found - Aliexpress.com'):
                    
                    title=driver.find_element(By.CLASS_NAME,'title--wrap--Ms9Zv4A')
                    title=title.find_element(By.TAG_NAME,'h1').text
                    #price
                    price=driver.find_element(By.CLASS_NAME , 'es--wrap--erdmPRe')
                    sp=price.find_elements(By.TAG_NAME,"span")
                    price=''
                    for y in range(2,len(sp)):
                        price+=sp[y].text
                    price=float(price)
                    img_data=''
                    img_list=[]
                    div_slide=driver.find_elements(By.CLASS_NAME,'slider--img--D7MJNPZ')
                    for x in div_slide:
                        img_list.append(str(x.find_element(By.TAG_NAME,'img').get_attribute('src')).replace('80x80.jpg_',''))
        
                    today = date.today()

                    for y in range(0,len(img_list)):
                        if(j==len(new_link_list)-1 and y==len(new_link_list)-1):
                            collection_query+=f'({id},"{img_list[y]}","{today}");'
                        else:
                            collection_query+=f'({id},"{img_list[y]}","{today}"),'
                    video_src=''
                    try:
                        video=driver.find_element(By.CLASS_NAME,'video--video--Zj0EIzE')
                        video_src=video.find_element(By.TAG_NAME,'source').get_attribute('src')
                    except Exception as e:
                        print('video not founded')
                    DDP=0
                    try:
                        choice=driver.find_element(By.CLASS_NAME,'banner-choice--logo--Vq3YIx6')
                        DDP=1
                    except Exception as e:
                        print('product not suport ddp')
                    print(title)
                    price=float("{:.2f}".format(price/10.31))
                    print(price)
                    today = date.today()
                    if(j!=len(new_link_list)-1):
                        query+=f'({id},"{title}",{i},"{img_list[0]}","{video_src}","{url}","{title}","{title}",{price},2,{DDP},"{today}","{today}"),'
                    else:
                        query+=f'({id},"{title}",{i},"{img_list[0]}","{video_src}","{url}","{title}","{title}",{price},2,{DDP},"{today}","{today}");'
                    
                    id+=1
                err=2
                reste-=1

            except Exception as e:
                err+=1
                print("some tag not found")
                driver.close()
    last_id=id+1        
    with open(f'Docs/product_data_ali/product_ali_{cats[i-1]}.txt', 'w',encoding='utf8') as f:
        f.write(query)
        f.write(collection_query)
    print(query)

