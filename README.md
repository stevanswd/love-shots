# Love Shots

It's a Drupal 11 project that allows your wedding guests to upload photos so you can create a love album.

## About Drupal

<img alt="Drupal Logo" src="https://www.drupal.org/files/Wordmark_blue_RGB.png" height="60px">

Drupal is an open source content management platform supporting a variety of
websites ranging from personal weblogs to large community-driven websites. For
more information, visit the Drupal website, [Drupal.org](Drupal.org), and join
the [Drupal community](https://www.drupal.org/community).

### Contributing to Drupal

Drupal is developed on [Drupal.org](Drupal.org), the home of the international
Drupal community since 2001!

### Usage

For a brief introduction, see [USAGE.txt](/core/USAGE.txt). You can also find
guides, API references, and more by visiting Drupal's [documentation](https://www.drupal.org/documentation).


## Running the Project with DDEV

This project uses [DDEV](https://ddev.readthedocs.io/) to provide a local
development environment for Drupal.

### Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop) installed and running
- [DDEV](https://ddev.readthedocs.io/en/stable/#installation) installed on your system

### Initialize the project

Clone the repository and move into the project folder:

```bash
git clone <your-repository-url>
cd <your-project-folder>
```

### Configure DDEV

```bash
ddev config --project-type=drupal9 --docroot=. --create-docroot
```

### Start the environment

```bash
ddev start
```

### Install Drupal

```bash
ddev drush site-install
```

### Access the project

Open your browser and navigate to `http://<your-project-folder>.ddev.site` to access your Drupal site.
