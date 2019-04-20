# Tic Tac Toe

## Requirements

* PHP 7.2
* composer

I'm running php.fpm and nginx with rewrite rules to handle REST calls.

```
    location / {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root/index.php;
    }

    location /frontend/ {
        index index.html;
    }
```
## Install
    git clone <repository url>
    
    cd tictactoe
    
    composer install
    
## Gameplay

Player always goes first and has the 'X' unit. AI replies with it's own move and has 'O' as it's unit.
The game is over when one or the other connects 3 in a row or diagonally. Draw is handled when there is no winner and no further possible moves.
