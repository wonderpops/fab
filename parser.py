import json
import subprocess
import sys
from statistics import *
import matplotlib.pyplot as plt

with open("search_cnfg.json", "w") as write_file:
    data = {"search": sys.argv[1]}
    json.dump(data, write_file)

f = open("searches/part_"+sys.argv[2]+".json", "w")
f.close()

subprocess.check_output('scrapy runspider main.py -o searches/part_'+sys.argv[2]+'.json')

# with open("quotes.json", "r") as read_file:
#     data = json.load(read_file)
#     prises = []
#     names = []
#     means = []

#     min_prise = 9999999
#     max_prise = 0
#     mean = 0
#     count = 0
#     for t in data:
#         if t['prise'] != None:
#             count += 1
#             t['prise'] = int(t['prise'].replace(' ',''))
#             if (t['prise'] > max_prise):
#                 max_prise = t['prise']
#             if (t['prise'] < min_prise):
#                 min_prise = t['prise']
#             mean += t['prise']
#             prises.append(t['prise'])
#             names.append(t['s_count'])
#             means.append(mean / count)

#     mean = mean / count

#     print(min_prise)
#     print(max_prise)
#     print(mean)

#     print(mode(prises))
#     print(median(prises))

#     plt.plot(names, prises)
#     plt.plot(names, means, color='g')
#     plt.axhline(mean, color='r')
#     plt.axhline(mode(prises), color='r')
#     plt.axhline(median(prises), color='r')
#     # plt.fill_between(names, prises, mean, color="g", alpha=0.3)
#     # plt.fill_between(names, prises, mode(prises), color="r", alpha=0.3)
#     plt.show()