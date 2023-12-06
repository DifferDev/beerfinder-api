![BeerFinder - Find your gold](public/imgs/beer-finder.png "BeerFinder - Find your gold")

# Beerfinder API
A simple Geolocation Beers API finder for PHPConference 2023 Training by Leonardo Tumadjian

# Roteiro
1. Apresentação do Projeto
2. Setup do projeto
3. Conhecendo o PHPStan
4. Conhecendo o Infection
5. TDD com Domain
6. TDD com UseCases
7. Resolvendo I/O com Presenter
8. Adicionando MongoDB em busca de Locations

# How to start?
```bash
$ docker compose up -d

# get in the container
$ shell/exec bash

$ composer install
```

# Composer commands obs: run inside container
```bash
# Fix de PSR-1/12
$ composer fix

# Verifica analise estática PHPStan
$ composer stan

# Rodar os testes
$ composer test

# Gerar o Coverage
$ composer cover

# Gerar o cover do Infection
$ composer infection
```
