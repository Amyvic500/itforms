# User Access Request Form

A Laravel Blade–based application for managing IT system user access requests across multiple enterprise systems.

## Overview

The **User Access Request Form** is designed to handle common IT access management scenarios, including:

- New user account creation
- Modification of existing user access
- Password resets
- Additional system authorizations

It supports multiple enterprise systems such as **SAP, Email, Internet, Remote Access, E-Leave, Ingress, Athena, and Spark**, providing a centralized and standardized access request workflow.

## Features

- **User Information Management**  
  Capture personal details, organizational information, and role assignments.

- **Multi-System Access Support**  
  Manage access requests for up to 8 enterprise systems within a single form.

- **Flexible Operations**
  - New ID creation
  - Delete ID
  - Reset password
  - Modify existing ID access

- **File Uploads**  
  Attach templates and application description documents.

- **Dynamic Forms**  
  Conditional fields rendered based on request type and selected systems.

- **Approval Workflow**  
  Automatic Head of Department (HOD) email population and approval routing.

## Supported Systems

| System   | Purpose                     |
|----------|-----------------------------|
| Athena   | Internal application        |
| Email    | Corporate email             |
| Internet | Web access                  |
| Remote   | VPN / Remote desktop access |
| E-Leave  | Leave management            |
| SAP      | ERP system                  |
| Ingress  | Time & attendance           |
| Spark    | Communication platform      |

## Technical Stack

- **Framework:** Laravel (Blade)
- **UI:** Bootstrap, Font Awesome
- **Controller:** `ReqController@store`
- **Validation:**
  - Required fields
  - Email format
  - Numeric extension

## Installation & Usage

See the following file for Docker-based setup and deployment:

[Installation_Docker.md](Installation_Docker.md)
