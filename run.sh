#!/bin/bash

export $(cat .env)
php -S localhost:5000
