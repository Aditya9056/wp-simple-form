[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url] 

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/Aditya9056/wp-simple-form">
    <img src="public/images/contact-form.png" alt="WP Simple Form" width="100">
  </a>

  <h3 align="center">WP Simple Form</h3>

  <p align="center">
    It's a Simple WordPress plugin.
    <!-- <a href="https://github.com/Aditya9056/wp-simple-form/issues">Request Feature</a> -->
  </p>
</p>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

## About The Project

<!-- [![Product Name Screen Shot][product-screenshot]](https://example.com) -->
<!-- `aditya9056`, `a-wordpress-theme` and `It's a wordpress theme` -->

It's a wordpress form plugin that can be used via a shortcode `wp-simple-form` that will render these 5 fields by default.

* Name
* Phone Number
* Email Address
* Desired Budget
* Message

### Built With

* JavaScript ES Next
* PHP
* WordPress

<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

* WordPress Installed

### Features

1. It has `honeypot` for avoiding spam.
2. It uses `AJAX` for submititng form.
3. Form is `responsive`.
4. Form uses `wp_nonce` for validation.
5. Submitted posts are **not visibe by public**.
6. Public users **can also submit forms**.

### Installation

1. Clone the repo in `plugin` folder in `wordpress-content/plugins` folder.

   ```sh
   git clone https://github.com/Aditya9056/wp-simple-form
   ```

## Usage

Simply add this shortcode in add post `wp-simple-form`.

Use these examples to understand all the **shorcode parameters**.
As we said shortcode is `wp-simple-form`.

Label Parameters:-

* `name_label`
* `phone_label`
* `email_label`
* `budget_label`
* `message_label`
  
### E.g. usage for `name_label`

  ```php
  [wp-simple-form name_label="A New Label"]
  ```

`Maxlength` Parameters:-

* `maxlength` default is `50`, it covers name, phone-number, email and budget.
* `msg_maxlength` default is `400`, it covers message(`texarea`).

### E.g. usage for `maxlength`

  ```php
  [wp-simple-form maxlength="30"]
  ```

`rows` and `cols` Parameters for `textarea`:-

* `rows` default is `30`, it defines rows.
* `cols` default is `50`, it defines columns.

### E.g. usage for `rows` and `cols`

  ```php
  [wp-simple-form rows="40" cols="60"]
  ```

## Forms Parameter Include

1. `wp_nonce`
2. `date-time`
3. `name`
4. `phone`
5. `email`
6. `budget`
7. `message`

To grab form fields value use this simple snippet in developer console.

```javascript
jQuery('#name').val()
```

## Roadmap

See the [open issues](https://github.com/aditya9056/wp-simple-form/issues) for a list of proposed features (and known issues).

## Contributing

### Coding Standards
* WordPress (WPCS)

#### `phpcs` may show some errors but you can safely ignore them for now.
  
Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the MIT License. See `LICENSE` for more information.


[contributors-shield]: https://img.shields.io/github/contributors/Aditya9056/repo.svg?style=for-the-badge
[contributors-url]: https://github.com/Aditya9056/wp-simple-form/graphs/contributors

[forks-shield]: https://img.shields.io/github/forks/Aditya9056/repo.svg?style=for-the-badge
[forks-url]: https://github.com/Aditya9056/wp-simple-form/network/members

[stars-shield]: https://img.shields.io/github/stars/Aditya9056/repo.svg?style=for-the-badge
[stars-url]: https://github.com/Aditya9056/wp-simple-form/stargazers

[issues-shield]: https://img.shields.io/github/issues/Aditya9056/repo.svg?style=for-the-badge
[issues-url]: https://github.com/Aditya9056/wp-simple-form/issues

[license-shield]: https://img.shields.io/github/license/Aditya9056/a-wordpress-theme.svg?style=for-the-badge
[license-url]: https://github.com/Aditya9056/wp-simple-form/blob/master/LICENSE.txt

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/iadityajain