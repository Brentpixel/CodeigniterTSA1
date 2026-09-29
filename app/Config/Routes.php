<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Tasks for Today Management System — Route Definitions ────────────────────
//
//  /          → Home::index()    — Tasks for today (Asia/Manila date)
//  /tasks     → Tasks::index()   — All tasks ordered by date
//  /profile   → Profile::index() — Single demo user
//  /about     → About::index()   — Static developer page
// ─────────────────────────────────────────────────────────────────────────────

$routes->get('/',        'Home::index');
$routes->get('/tasks',   'Tasks::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/about',   'About::index');
