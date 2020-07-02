import scrapy
import json
from scrapy import FormRequest
from scrapy.shell import inspect_response
import urllib.parse

            
class QuotesSpider(scrapy.Spider):
    page = 2
    count = 0
    name = 'quotes'
    start_urls = [
        'https://www.farpost.ru/vladivostok/',
    ]

    def parse(self, response):
        with open("parser/search_cnfg.json", "r") as read_file:
            data = json.load(read_file)
        s = data['search'].encode('ascii',errors='surrogateescape').decode('utf-8')
        next_page = response.url + 'dir?query=' + str(urllib.parse.quote_plus(s))
        yield response.follow(next_page, self.search)
        

    def search(self, response):
        
        results_count = int(response.css('#itemsCount_placeholder').attrib['data-count'])
        for item in response.css('div.bull-item-content'):
            if self.count < results_count:
                self.count += 1
                yield {
                    's_count': self.count,
                    'r': results_count,
                    'title': item.css('div.bull-item-content__subject-container a::text').get(),
                    'link': 'https://farpost.ru' + item.css('div.bull-item-content__subject-container a').attrib['href'],
                    'prise': item.css('div.price-block__final-price span::text').get(),
                }
            else:
                self.crawler.engine.close_spider(self, reason='finished')

        while((response != None)and(self.count < results_count)and(self.count < 500)):
            next_page = response.url + '&?page' + str(self.page)
            self.page += 1
            yield response.follow(next_page, self.search)


# print(urllib.parse.quote_plus(s))

    # def parse(self, response):
    #     for item in response.css('div.bull-item-content'):
    #         yield {
    #             'title': item.css('div.bull-item-content__subject-container a::text').get(),
    #             'prise': item.css('div.price-block__final-price span::text').get(),
    #             'subtitle': item.css('div.bull-item__annotation-row::text').get(),
    #         }

    #     page = 2
    #     while(response != None):
    #         next_page = response.url + '?page' + str(page)
    #         page += 1
    #         yield response.follow(next_page, self.parse)