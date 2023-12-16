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
path="C:\\Program Files (x86)\\chromedriver.exe"

#####-------------table teams --------------------##
with open('Docs\\league.csv',mode='r') as csv_league:
    csv_reader = csv.reader(csv_league, delimiter=',')
    leagues=[]
    table_teams_dict={}
    for ff in csv_league:
        leagues.append(ff)
    list_leagues=[]
    cparateur=0
    while(cparateur!=12):
        driver=webdriver.Chrome()
        try:
            driver.get(leagues[cparateur].strip())
            dict_leagues={}
            list_teams_infos=[]
            title=driver.find_element(By.CLASS_NAME,'ROA474A54iOw7VMIYeSY')
                
            print(title.text)   
            table=driver.find_element(By.CLASS_NAME,'ag-center-cols-container')
                    
                       
            
            table_items=table.find_elements(By.CLASS_NAME,'ag-row-level-0')
            table_items_length=len(table_items)
                
                            
            cp=1
            for item in table_items:
                dict_teams_infos={}
            
                
                team=item.find_element(By.CLASS_NAME,'XiH7Q7qqQpsHxb_Z3I6N')
                        
                team_name=team.get_attribute('title')
                print(team_name)
                
                logo=team.find_element(By.CLASS_NAME,'pk-badge').get_attribute('src')
                    
                img_data=''
                if logo is None:
                    img_data=b'images\\table_teames_logo\\football.png'
                else:
                    img_data = requests.get(logo).content
                
                path=f'images\\table_teames_logo\\{team_name}.png '
                isExisting=os.path.exists(path)
                if isExisting==False:
                    with open(f'images\\table_teames_logo\\{team_name}.png', 'wb') as handler:
                        handler.write(img_data)

                
                infos=item.find_elements(By.CLASS_NAME,'ag-cell')
                infos_leng=len(infos)
                
                dict_teams_infos['id_team']=cp
                dict_teams_infos['team Name']=team_name
                dict_teams_infos['logo path']=f'images\\table_teames_logo\\{team_name}.png'
                dict_teams_infos['played']=infos[1].text
                dict_teams_infos['won']=infos[2].text
                dict_teams_infos['drawn']=infos[3].text
                dict_teams_infos['lost']=infos[4].text
                dict_teams_infos['goals']=infos[5].text
                dict_teams_infos['against']=infos[6].text
                dict_teams_infos['goal_differences']=infos[7].text
                dict_teams_infos['points']=infos[8].text
                list_teams_infos.append(dict_teams_infos)
                cp+=1
            dict_leagues[title.text]=list_teams_infos
            with open(f'Docs/teams_table/{title.text}.json','w',encoding='utf-8') as table_1:
                json.dump(dict_leagues,table_1,ensure_ascii=False)
            list_leagues.append(dict_leagues)
            cparateur+=1
        except Exception as e:
            print(e)
            driver.close()
        # print(dict_leagues)
        
    table_teams_dict['table leagues']=list_leagues
    with open('Docs/table_teams.json','w',encoding='utf-8') as table_teams:
        json.dump(table_teams_dict,table_teams,ensure_ascii=False)
    
    
    
    
    
