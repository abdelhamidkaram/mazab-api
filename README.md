# mazab-api
# Mazad — Auction Marketplace Backend

Mazad is a marketplace and auction platform backend built with Laravel.

The system is designed to support product listings, timed auctions, real-time bidding, user management, notifications, media storage, and administrative management.

This project is also being developed as a practical backend and system-design project, with a focus on clean architecture, database integrity, security, concurrency, observability, and scalability.

> 🚧 The project is currently under active development.

---

- [Database Diagram](#database-diagram)

## Overview

Mazad allows users to:

- Create and manage product listings
- Upload product images and videos
- Submit products for admin approval
- Schedule and manage auctions
- Participate in timed auctions
- Place bids
- Set a minimum bid increment
- Set a buyout price
- Follow/favorite auctions
- Receive notifications
- Contact customer support

Administrators can:

- Manage users
- Review and approve products
- Manage auctions
- Manage categories
- Manage application settings
- Manage FAQs
- Manage support tickets
- Manage notification settings
- Monitor platform activity

The backend provides both:

- REST API for the Flutter mobile application
- Web-based admin panel using Laravel + Inertia

---

# Architecture

The system follows a modular monolithic architecture.

```text
                         ┌──────────────────┐
                         │   Flutter App    │
                         │   Mobile Client  │
                         └────────┬─────────┘
                                  │
                                  │ REST API
                                  ▼
┌─────────────────────────────────────────────────────┐
│                  Mazad Backend                      │
│                                                     │
│  ┌─────────────────┐       ┌────────────────────┐   │
│  │  REST API       │       │  Admin Panel       │   │
│  │  for Flutter    │       │  Laravel + Inertia │   │
│  └────────┬────────┘       └─────────┬──────────┘   │
│           │                          │              │
│           └────────────┬─────────────┘              │
│                        │                            │
│                  Application Layer                  │
│                        │                            │
│          ┌─────────────┴─────────────┐              │
│          │                           │              │
│       Database                    Redis             │
│                                                     │
└─────────────────────────────────────────────────────┘
             │                         │
             ▼                         ▼
       Firebase                    Cloudflare R2
       ├── OTP                    ├── Images
       └── FCM                    └── Videos

       

```


## Database Diagram

```mermaid
erDiagram
	Products ||--o{ auctions : references
	Products ||--o{ product_media : references
	auctions ||--o{ bids : references
	auctions ||--o{ favorites : references
	categories ||--o{ category_auction : references
	categories ||--o{ categories : references
	support_tickets ||--o{ support_ticket_replies : references
	users ||--|| profiles : references
	users ||--o{ Products : references
	users ||--o{ Addresses : references
	users ||--o{ favorites : references
	users ||--o{ bids : references
	users ||--o{ user_devices : references
	users ||--o{ user_notification_preferences : references
	users ||--o{ support_ticket_replies : references
	auctions ||--o{ category_auction : references

	users {
		BIGINT id
		VARCHAR name
		VARCHAR email
		VARCHAR password
		VARCHAR role
		VARCHAR(255) status
	}

	profiles {
		BIGINT id
		BIGINT user_id
		VARCHAR phone
		VARCHAR avatar_url
		TEXT bio
		BIGINT adress_id
	}

	Addresses {
		BIGINT id
		BIGINT user_id
		VARCHAR type
		VARCHAR country
		VARCHAR state
		VARCHAR street
		VARCHAR address_line1
		VARCHAR address_line2
		VARCHAR city
		VARCHAR postal_code
	}

	Products {
		BIGINT id
		BIGINT user_id
		VARCHAR status
		VARCHAR title
		TEXT description
		TEXT short_description
	}

	auctions {
		BIGINT id
		BIGINT products_id
		VARCHAR status
		DECIMAL buyout_price
		DECIMAL starting_price
		DECIMAL current_price
		DATETIME start_time
		DATETIME end_time
		DECIMAL minimum_bid_increment
		BIGINT winning_bid_id
		INT bid_count
		VARCHAR currency
		DATETIME closed_at
	}

	bids {
		BIGINT id
		BIGINT auction_id
		BIGINT user_id
		DECIMAL amount
	}

	categories {
		BIGINT id
		VARCHAR name
		VARCHAR icon_url
		BIGINT parent_id
	}

	category_auction {
		BIGINT id
		BIGINT auction_id
		BIGINT category_id
		BOOLEAN is_primary
	}

	favorites {
		BIGINT id
		BIGINT auction_id
		BIGINT user_id
	}

	support_tickets {
		BIGINT id
		VARCHAR subject
		TEXT body
		VARCHAR email
		TEXT attachments_urls
	}

	support_ticket_replies {
		BIGINT id
		BIGINT ticket_id
		TEXT body
		BIGINT user_id
		TEXT attachments_urls
	}

	faqs {
		BIGINT id
		TEXT Question
		TEXT answer
		INT priority
	}

	user_devices {
		BIGINT id
		BIGINT user_id
		VARCHAR token
		VARCHAR platform
		BOOLEAN is_active
	}

	notifications {
		UUID id
		VARCHAR type
		VARCHAR notifiable_type
		BIGINT notifiable_id
		TEXT data
		DATETIME read_at
		DATETIME created_at
		DATETIME updated_at
	}

	notification_templates {
		BIGINT id
	}

	user_notification_preferences {
		BIGINT user_id
		VARCHAR notification_type
		BOOLEAN email_enabled
		BOOLEAN sms_enabled
		BOOLEAN push_enabled
		BOOLEAN in_app_enabled
	}

	app_settings {
		BIGINT id
		VARCHAR key
		TEXT value
		VARCHAR type
	}

	social_links {
		BIGINT id
		VARCHAR key
		VARCHAR url
		VARCHAR icon_url
	}

	product_media {
		BIGINT id
		BIGINT product_id
		VARCHAR type
		VARCHAR path
		VARCHAR mime_type
		BIGINT size
		INT sort_order
		BOOLEAN thumbnail
	}
