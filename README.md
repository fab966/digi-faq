# Joomla 5 FAQ Module
![Joomla 5 Supported](https://img.shields.io/badge/Joomla-5.x-%234F9F4A?logo=joomla)
![GPL License](https://img.shields.io/badge/license-GPL%20v2%2B-blue)

A flexible and SEO-friendly FAQ module for Joomla 5 by Fabrizio Galuppi - Digitest.  
Easily manage, display, and optimize frequently asked questions on your site, supporting both extensive user-facing answers and concise structured data for search engines.

## Features

- **FAQs**  
  Configure between 3 and 12 FAQ entries.
- **Dual Answer Format**  
  For each question, provide:
  - A **public, extended answer** (rich HTML)
  - A **short answer** used for [FAQPage Schema Markup](https://developers.google.com/search/docs/appearance/structured-data/faqpage)
- **Drag & Drop Ordering**  
  Easily reorder questions in the admin UI with drag-and-drop.
- **SEO Optimized**  
  Outputs valid [JSON-LD FAQPage schema](https://schema.org/FAQPage) embedded in the page for rich search results.
- **Modern Output**  
  Utilizes semantic `/` HTML5 elements for accessibility and a clean user experience.
- **Customizable Styling**  
  Output includes CSS classes for easy theme integration and customization.
- **Modular & Extensible**  
  Clean architecture suited for further enhancements.

## Installation

1. Download the latest release as a ZIP package.
2. In the Joomla administrator panel, go to **Extensions > Manage > Install**.
3. Upload the ZIP package and proceed with installation.
4. Add the module to a position in your template.

## Configuration

- Go to **Extensions > Modules** and create or edit an instance of the FAQ module.
- Enter your questions and answers:
  - Use the rich text editor for extended public answers.
  - Use the plain text field for concise answers for schema markup.
- Drag and drop to reorder questions.
- Adjust styling by modifying CSS classes if desired.
- The module will automatically inject valid FAQPage JSON-LD schema into the page.

## Output Examples

**Frontend HTML**:
```html

  What is Joomla?
  
    Joomla is a free and open-source content management system for publishing web content...
  

```

**FAQPage JSON-LD Schema** (output in ``):
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is Joomla?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Joomla is a free and open-source CMS."
      }
    },
    ...
  ]
}
```

## Customization

- **CSS**  
  Use or override the included CSS classes (`faq-module`, `faq-item`, `faq-question`, `faq-answer`) in your template or custom stylesheet.

- **Templates**  
  Feel free to customize `tmpl/default.php` to fit your design.

## Development

Contributions and issue reports are welcome!  
Currently, this repository is private but intended to enable further development and collaboration.

- **Clone the repo**  
  `git clone `
- **Open issues** for suggestions or bug reports.
- **Fork** and submit pull requests for enhancements.

## License

This project is released under the [GNU GPL v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

## Credits

Developed & maintained by [Your Name / Team].  
Inspired by open web standards and Joomla community best practices.

## Links

- [Joomla Documentation](https://docs.joomla.org/)
- [Schema.org FAQPage](https://schema.org/FAQPage)

> **Note:** For any questions, please open an issue in this repository or contact the maintainer.

Feel free to adapt this template further as your module evolves!
