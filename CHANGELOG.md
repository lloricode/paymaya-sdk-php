# Changelog

All notable changes to `paymaya-sdk-php` will be documented in this file

## 0.4.X - 2021-XX-XX

- Add return raw from Paymaya API
- Add send json raw to Paymaya API

## 0.4.4 - 2021-04-06

- Optimise Guzzle Client parameter with handler

## 0.4.3 - 2021-03-22

- Add default headers

## 0.4.2 - 2021-03-05

- Add delete customization
- Set null all customization properties if there is no return by paymaya api

## 0.4.1 - 2021-03-01

- Handle 404 when customization is empty

## 0.4.0 - 2021-02-26

- Move webhook class
- Add checkout customization

## 0.3.0 - 2021-02-23

- Add show checkout with id
- Set all properties to public (to compatible also in spatie DTO)
- Add spatie DTO (https://github.com/spatie/data-transfer-object)
- Rename all properties depends on paymaya response
- Remove all getter
- Rename all classes depends on paymaya
- Remove all ::new() functions (fix for psalm)

## 0.2.2 - 2021-02-08

- Set ::new() as deprecate
- Set compatible for lloriode/laravel-paymaya-sdk

## 0.2.1 - 2021-02-05

- Increase code coverage

## 0.2.0 - 2021-02-05

- Use guzzle mock for testing
- Add support PHP 8

## 0.1.1 - 2020-11-13

- Add support in a composer.json file

## 0.1.0 - 2020-10-28

- Add more attribute in webhooks
- Rename some methods in clients

## 0.0.4 - 2020-10-27

- Add webhook (create, get, update, delete, deleteAll)

## 0.0.3 - 2020-10-22

- Set null another some buyer attributes

## 0.0.2 - 2020-10-22

- Set meta data as nullable

## 0.0.1 - 2020-10-22

- initial release pre release
