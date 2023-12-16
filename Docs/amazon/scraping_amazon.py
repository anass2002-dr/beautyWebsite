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

last_id=0
for i in range(0,len(cats)):
    links_list=[]
    with open(f'Docs/amazon/excel/amazon_link_{cats[i]}.csv','r',encoding='utf8') as filecsv:
        csv_reader = csv.reader(filecsv, delimiter=',')
        for ff in csv_reader:
            links_list.append(ff)
    print(cats[i])
    query="INSERT INTO `product` (`PRODUCT_ID`,`TITLE`, `CATEGORY_ID`, `PHOTO`, `VIDEO`, `PRODUCT_LINK`, `CONTENT`, `PRODUCT_SHORT`, `PRODUCT_PRICE`, `SPONSOR_ID`,`DDP`, `CREATED_DATE`, `UPDATE_DATE`) values"
    collection_query="INSERT INTO `product_collection_photos`(`PRODUCT_ID`, `PHOTO_PATH`, `UPDATE_DATE`) VALUES"
    new_link_list=[]
    for link in links_list:
        for x in link:
            y=x.split('?')
            new_link_list.append(y[0])
        # new_link_list.append(link[0])
    id=0
    if last_id==0:
        id=2000
    else:
        id=last_id
    reste=len(new_link_list)
    for j in range(0,len(new_link_list)):
        print(cats[i])
        print(f'the rest is of link is : {reste}')
        err=0
        url=str(new_link_list[j])
        if url!='https://www.amazon.com/sspa/click':
            
            print(url)

            while(err!=2):
                try:
                                    
                    driver=webdriver.Chrome()
                    driver.set_window_position(-10000,0)
                    driver.get(str(url))
                    # time.sleep(2000)
                    title=driver.find_element(By.ID,'productTitle').text
                    price_section=driver.find_element(By.CLASS_NAME,'reinventPricePriceToPayMargin')
                    price=price_section.find_element(By.CLASS_NAME,'a-price-whole').text
                    price_dot=price_section.find_element(By.CLASS_NAME,'a-price-fraction').text
                    # price=price.replace('$','')
                    price=str(price)+'.'+str(price_dot)
                    price=float(price)
                    desc1=driver.find_element(By.ID,'productOverview_feature_div')
                    desc1=desc1.find_element(By.CLASS_NAME,'a-section')
                    desc2=driver.find_element(By.ID,'featurebullets_feature_div')
                    description=str(desc2.get_attribute('innerHTML'))+str(desc1.get_attribute('innerHTML'))
                    description=description.replace("\"""","\'")
                    print(title)
                    print(price)
                    img_grid=driver.find_element(By.CLASS_NAME,'regularAltImageViewLayout')
                    imgs=img_grid.find_elements(By.TAG_NAME,'img')
                    list_img=[]
                    for img in imgs:
                        new_img=img.get_attribute('src')
                        if 'play-icon-overlay' not in new_img and 'icon' not in new_img:
                            new_img=new_img.split('._')
                            new_img[1]=new_img[1].split('.')
                            img_result=new_img[0]+'.'+new_img[1][1]
                            list_img.append(img_result) 
                    today = date.today()

                    for y in list_img:
                        if(j==len(new_link_list)-1):
                            collection_query+=f'({id},"{y}","{today}");'
                        else:
                            collection_query+=f'({id},"{y}","{today}"),'
                    video_src=''
                    
                    DDP=0
                
                
                    today = date.today()
                    if(j!=len(new_link_list)-1):
                        query+=f'({id},"{title}",{i+1},"{list_img[0]}","{video_src}","{url}","{description}","{title}",{price},3,{DDP},"{today}","{today}"),'
                    else:
                        query+=f'({id},"{title}",{i+1},"{list_img[0]}","{video_src}","{url}","{description}","{title}",{price},3,{DDP},"{today}","{today}");'
                    
                    id+=1
                    err=2
                    reste-=1

                except Exception as e:
                    err+=1
                    print("some tag not found")
                    driver.close()

    last_id=id+1        
    with open(f'Docs/amazon/product_data_amazon/product_amazon_{cats[i-1]}.txt', 'w',encoding='utf8') as f:
        f.write(query)
        f.write(collection_query)
    print(query)

