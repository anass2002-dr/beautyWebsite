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


<<<<<<< HEAD
# url2='https://www.amazon.com/Hempz-Body-Lotion-Moisturizing-Moisturizer/dp/B0BNP8TWQ9/ref=sr_1_139?keywords=Body+Skin+Care+Products&qid=1699869068&s=beauty&sr=1-139'
t="hello \"mean"
t=t.replace("\"","'")
print(t)
=======
url='https://www.amazon.com/Jabra-Active-Bluetooth-Earbuds-Built/dp/B09MVGQRDD/ref=sxin_17_pa_sp_search_thematic_sspa?adgrpid=155926294200&content-id=amzn1.sym.e0f7d8e5-6c81-4b07-b83b-2ec00eebe75e%3Aamzn1.sym.e0f7d8e5-6c81-4b07-b83b-2ec00eebe75e&cv_ct_cx=amazon&hvadid=673726437747&hvdev=c&hvlocphy=1009988&hvnetw=g&hvqmt=b&hvrand=10784031669819766923&hvtargid=kwd-296559188389&hydadcr=21646_13513911&keywords=amazon&pd_rd_i=B09MVGQRDD&pd_rd_r=8e78c63a-b7a4-4c90-810a-3e10e36212c7&pd_rd_w=KasmP&pd_rd_wg=bAu4G&pf_rd_p=e0f7d8e5-6c81-4b07-b83b-2ec00eebe75e&pf_rd_r=8K99DNS3SK7HBXGXN4QC&qid=1699987715&sbo=RZvfv%2F%2FHxDF%2BO5021pAnSA%3D%3D&sr=1-2-2c727eeb-987f-452f-86bd-c2978cc9d8b9-spons&sp_csd=d2lkZ2V0TmFtZT1zcF9zZWFyY2hfdGhlbWF0aWM&th=1'
driver=webdriver.Chrome()
# driver.set_window_position(-10000,0)
driver.get(str(url))
time.sleep(200)
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



# url='https://rankactive.com/resources/generate-keywords'
>>>>>>> 583054af5b6d2380de9896a95981ee5bb00676b6
# driver=webdriver.Chrome()
# driver.set_window_position(-10000,0)
# driver.get(str(url))

<<<<<<< HEAD
# title=driver.find_element(By.ID,'productTitle').text
# price_section=driver.find_element(By.CLASS_NAME,'reinventPricePriceToPayMargin')
# price=price_section.find_element(By.CLASS_NAME,'a-price-whole').text
# price_dot=price_section.find_element(By.CLASS_NAME,'a-price-fraction').text
# # price=price.replace('$','')
# price=str(price)+'.'+str(price_dot)
# price=float(price)
# desc1=driver.find_element(By.ID,'productOverview_feature_div')
# desc1=desc1.find_element(By.CLASS_NAME,'a-section')
# desc2=driver.find_element(By.ID,'featurebullets_feature_div')

# print(title)
# print(price)
# img_grid=driver.find_element(By.CLASS_NAME,'regularAltImageViewLayout')
# imgs=img_grid.find_elements(By.TAG_NAME,'img')
# list_img=[]
# for img in imgs:
#     new_img=img.get_attribute('src')
#     if 'play-icon-overlay' not in new_img and 'icon' not in new_img:
#         new_img=new_img.split('._')
#         new_img[1]=new_img[1].split('.')
#         img_result=new_img[0]+'.'+new_img[1][1]
#         list_img.append(img_result) 



# url='https://rankactive.com/resources/generate-keywords'
# driver=webdriver.Chrome()
# driver.set_window_position(-10000,0)
# driver.get(str(url))

=======
>>>>>>> 583054af5b6d2380de9896a95981ee5bb00676b6
# input_txt=driver.find_element(By.ID,'searchQuery')
# input_txt.send_keys(url2)
# btn=driver.find_element(By.ID,'formButton').click()
# time.sleep(200)
# result=driver.find_element(By.ID,'results')
# rows=driver.find_elements(By.CLASS_NAME,'default-row')
# keywords=''
# for x in rows:
#     td=x.find_elements(By.TAG_NAME,'td')
#     for y in td:
#         print(y.get_attribute("innerHTML"))
    # keywords+=x.text+','
    

# with open('Docs/amazon/keywords.txt','w',encoding='utf8') as file_key:
#     file_key.write(keywords)
