# mazab-api
# Mazad — Auction Marketplace Backend

Mazad is a marketplace and auction platform backend built with Laravel.

The system is designed to support product listings, timed auctions, real-time bidding, user management, notifications, media storage, and administrative management.

This project is also being developed as a practical backend and system-design project, with a focus on clean architecture, database integrity, security, concurrency, observability, and scalability.

> 🚧 The project is currently under active development.

---

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

       