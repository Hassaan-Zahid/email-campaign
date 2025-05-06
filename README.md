# Laravel Email Campaign Package

A Laravel package for managing and sending email campaigns.

## Installation

1. Install the package via composer:
```bash
composer require hassaan/email-campaign
```

2. Publish the configuration file:
```bash
php artisan vendor:publish --provider="EmailCampaign\Providers\EmailCampaignServiceProvider" --tag="config"
```

3. Run the migrations:
```bash
php artisan migrate
```

## Usage

### API Endpoints

#### Customers
- `GET /api/email-campaign/customers` - List all customers
    - Query parameters:
        - `status` - Filter by status (Paid, Grace period, Expired)
        - `expires_within_days` - Filter by plan expiry date

#### Campaigns
- `GET /api/email-campaign/campaigns` - List all campaigns
- `POST /api/email-campaign/campaigns` - Create a new campaign
    - Required fields: `title`, `subject`, `body`
- `GET /api/email-campaign/campaigns/{id}` - Get a specific campaign
- `POST /api/email-campaign/campaigns/{id}/attach-recipients` - Attach customers to a specific campaign
- `GET /api/email-campaign/campaigns/{id}-recipients` - List customers in a specific campaign
- `POST /api/email-campaign/campaigns/{id}/send` - Send a campaign

## Configuration

Set your email provider in the `.env` file:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```


## Final Notes

This implementation provides a complete Laravel package for email campaigns with:
1. Customer import functionality (via the provided SQL file)
2. Campaign creation and management
3. Customer filtering based on status and expiry date
4. Email sending with queue support
5. Delivery tracking
6. API-first approach with reusable endpoints
7. Proper validation and error handling
