# Installation and Usage with Docker

Since many systems now use upgraded PHP and Laravel versions, users may prefer not to downgrade their environments. Instead, you can use a Docker container to run this project. Below is a detailed guide on how to achieve this.

## Prerequisites

- Docker must be installed on your machine
- This setup was tested on the following operating system:

```text
Distributor ID: Ubuntu
Description:    Ubuntu 22.04.5 LTS
Release:        22.04
Codename:       jammy
```

## Setup Instructions

### 1. Environment Configuration

This guide assumes that `.env` doesn't exist in your project. Follow these steps to create it:

```bash
# Navigate to the project directory
e.g 
cd ../itforms //Please use your actual directory 

# Copy the Docker environment file
cp .env.docker .env
```

> **Note:** If you want to run the project directly without Docker, use `cp .env.example .env` instead.

### 2. Docker Setup and Execution

Run the following commands to build and start the Docker containers:

```bash
# Shut down any running containers (if needed)
docker compose down

# Build and start containers (this may take a few minutes on the first run)
docker compose up --build -d
```

**Expected output:**
```text
✔ Image itforms-app       Built                                           21.9s
✔ Network itforms_default Created                                         2.5s
✔ Container laravel54_db  Created                                         7.8s
✔ Container laravel54_app Created
```

### 3. Verify Containers Are Running

```bash
# Check that containers are running
docker ps
```

**Expected Or Similar output:**
```text
CONTAINER ID   IMAGE         COMMAND              CREATED        STATUS        PORTS                    NAMES
c7f0c8f0c8f0   itforms_app   "tail -f /dev/null"  2 minutes ago  Up 2 minutes  0.0.0.0:8000->8000/tcp   laravel54_app
```

### 4. Complete Laravel Setup

```bash
# Install Laravel dependencies
docker compose exec app composer install

# Generate application key
docker compose exec app php artisan key:generate

# Run database migrations
docker compose exec app php artisan migrate

# Set proper permissions for storage directories
docker compose exec app chmod -R 775 storage bootstrap/cache
```

### 5. Access the Application

Open your browser and navigate to:
```
http://localhost:8000
```

You should now see the Laravel application running successfully.

##
##
##
## Optional Commands

### Access Container Shell

```bash
# Enter the container's bash shell for additional commands
docker compose exec app bash
```

### Check Container Status

```bash
# View the status of all containers
docker compose ps
```

### Stop Containers

```bash
# Stop and remove all containers when finished
docker compose down
```

## Troubleshooting

If you encounter any issues:

1. Ensure Docker is running on your machine
2. Check that ports (especially 8000) are not already in use
3. Review container logs with `docker compose logs app`
4. Verify that all environment variables in `.env` are correctly configured

## Additional Information

For more help or to report issues, please refer to the project's main documentation or open an issue on GitHub.