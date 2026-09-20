# Github User Activity
This is a simple project, implementing Github user activity tracker using raw PHP, and Github API. \
It's a training app for structuring beginner project (such as this one) with PHP programming language and MVC structure. \
\
The caching system is also implemented using Redis ([predis/predis](https://packagist.org/packages/predis/predis) package), and minimal CSS using [PicoCSS](https://picocss.com/) framework.

## Installation and Instruction
Installation process for the app is simple. You just need to clone the repository:
``` bash
git clone https://github.com/DeathHashira/php-todo-list-mvc.git
```
Go to the project directory and install requirements:
```bash
composer install
```
And run the project on your localhost:
```bash
php -S localhost:8000 -t public/
```
But keep that in mind for the project to work fine, you need to also run redis-server on your `localhost:6379`. You can run it directly or run it on a Docker container (recommended).\
\
Note: You have to first install Docker and then pull the `redis` image from [Docker Hub](https://hub.docker.com/).
```bash
sudo docker pull redis
```
Then you can run redis-server in your container (make sure you're in the root directory of the project):
```bash
sudo docker run --rm -v ./data:/data -it --name myredis redis redis-server --appendonly yes
```
## Usage
This project is only for educational purpose of understanding the simple implementation of MVC (Router included), written in raw PHP.\
Also has been attempted to not use packages, and most of mechanisms are raw implemented (not complete) to make the process of understanding each mechanism easier.\
Updates will be added and remaining bugs will be fixed.

Note: The idea of this project is from [Roadmap.sh projects](https://roadmap.sh/projects/github-user-activity).

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.