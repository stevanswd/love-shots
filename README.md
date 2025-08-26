<img alt="Drupal Logo" src="https://www.drupal.org/files/Wordmark_blue_RGB.png" height="60px">

Drupal is an open source content management platform supporting a variety of
websites ranging from personal weblogs to large community-driven websites. For
more information, visit the Drupal website, [Drupal.org][Drupal.org], and join
the [Drupal community][Drupal community].

## Contributing

Drupal is developed on [Drupal.org](Drupal.org), the home of the international
Drupal community since 2001!

[Drupal.org][Drupal.org] hosts Drupal's [GitLab repository][GitLab repository],
its [issue queue][issue queue], and its [documentation][documentation]. Before
you start working on code, be sure to search the [issue queue][issue queue] and
create an issue if your aren't able to find an existing issue.

Every issue on Drupal.org automatically creates a new community-accessible fork
that you can contribute to. Learn more about the code contribution process on
the [Issue forks & merge requests page][issue forks].

## Usage

For a brief introduction, see [USAGE.txt](/core/USAGE.txt). You can also find
guides, API references, and more by visiting Drupal's [documentation
page][documentation].

You can quickly extend Drupal's core feature set by installing any of its
[thousands of free and open source modules][modules]. With Drupal and its
module ecosystem, you can often build most or all of what your project needs
before writing a single line of code.

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
