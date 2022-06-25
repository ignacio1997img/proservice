-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-06-2022 a las 20:16:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proservice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsible` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `user_id`, `name`, `responsible`, `identification`, `address`, `phone1`, `phone2`, `email`, `image`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`, `city_id`) VALUES
(1, 13, 'Entel', 'Andres', NULL, 'Av. Bolívar', '6848393', '6359452', 'entel@gmail.com', NULL, NULL, 1, '2022-06-16 23:15:34', '2022-06-16 23:16:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `busines`
--

CREATE TABLE `busines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rubro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsible` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 2,
  `star` int(11) NOT NULL DEFAULT 0,
  `cant` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `busines`
--

INSERT INTO `busines` (`id`, `rubro_id`, `user_id`, `nit`, `name`, `responsible`, `address`, `image`, `email`, `phone1`, `phone2`, `website`, `description`, `status`, `star`, `cant`, `created_at`, `updated_at`, `deleted_at`, `city_id`) VALUES
(1, 1, 7, '1918803014', 'Bulldog seguridad', 'Alfredo Arteaga', 'Valle patito', NULL, 'chichito@gmail.com', '69154634', NULL, NULL, NULL, 2, 0, 0, '2022-06-13 19:19:26', '2022-06-13 19:19:26', NULL, NULL),
(2, 1, 11, '648593995', 'Seguridad', 'Ignacio', 'Villa Corina', NULL, 'seguridad@gmail.com', '67285914', NULL, NULL, NULL, 2, 0, 0, '2022-06-16 22:58:04', '2022-06-16 22:58:04', NULL, NULL),
(3, 1, 12, '75839593', 'Seguridad', 'Pedro', 'Nueva Trinidad 2da entrada', NULL, 'segurity@gmail.com', '67285914', NULL, NULL, NULL, 2, 0, 0, '2022-06-16 23:07:06', '2022-06-16 23:07:06', NULL, NULL),
(4, 1, 14, '1918803013', 'Bulldog Security', 'marcos andres', 'ca,l,e', NULL, 'marcospersonalacc@gmail.com', '1234567', NULL, NULL, NULL, 2, 0, 0, '2022-06-17 01:24:10', '2022-06-17 01:24:10', NULL, NULL),
(5, 1, 15, '3255151014', 'Vigila', 'Roby Salvatierra', 'Av paragua c/Juan de Somoza #3720', NULL, 'vigila@gmail.com', '72845776', NULL, NULL, NULL, 2, 0, 0, '2022-06-18 16:28:23', '2022-06-18 16:28:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `busine_requirements`
--

CREATE TABLE `busine_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `busine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_lf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_roe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_pd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_modelo` smallint(6) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(22, 4, 'id', 'text', 'Id', 1, 1, 1, 0, 0, 0, '{}', 1),
(23, 4, 'name', 'text', 'Nombre', 0, 1, 1, 1, 1, 1, '{}', 2),
(24, 4, 'description', 'text', 'Descripcion', 0, 1, 1, 1, 1, 1, '{}', 3),
(25, 4, 'image', 'text', 'Image', 0, 0, 0, 0, 0, 0, '{}', 4),
(26, 4, 'status', 'checkbox', 'Estado', 1, 1, 1, 1, 1, 1, '{\"on\":\"Activo\",\"off\":\"Inactivo\",\"checked\":true}', 5),
(27, 4, 'created_at', 'timestamp', 'Creado', 0, 1, 1, 0, 0, 0, '{}', 6),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(29, 4, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 8),
(30, 6, 'id', 'text', 'Id', 1, 1, 1, 0, 0, 0, '{}', 1),
(31, 6, 'name', 'text', 'Nombre', 0, 1, 1, 1, 1, 1, '{}', 2),
(32, 6, 'description', 'text', 'Descripcion', 0, 1, 1, 1, 1, 1, '{}', 3),
(33, 6, 'image', 'text', 'Image', 0, 0, 0, 0, 0, 0, '{}', 4),
(34, 6, 'status', 'checkbox', 'Estado', 1, 1, 1, 1, 1, 1, '{\"on\":\"Activo\",\"off\":\"Inactivo\",\"checked\":true}', 5),
(35, 6, 'created_at', 'timestamp', 'Creado', 0, 1, 1, 0, 0, 0, '{}', 6),
(36, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(37, 6, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 8),
(44, 9, 'id', 'text', 'Id', 1, 1, 0, 0, 0, 0, '{}', 1),
(45, 9, 'name', 'text', 'Nombre', 0, 1, 1, 1, 1, 1, '{}', 2),
(46, 9, 'status', 'checkbox', 'Estado', 1, 1, 1, 1, 1, 1, '{\"on\":\"Activo\",\"off\":\"Inactivo\",\"checked\":true}', 3),
(47, 9, 'created_at', 'timestamp', 'Creado', 0, 1, 1, 1, 0, 0, '{}', 4),
(48, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(49, 9, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 6),
(56, 11, 'id', 'text', 'Id', 1, 1, 1, 0, 0, 0, '{}', 1),
(57, 11, 'name', 'text', 'Ciudad', 0, 1, 1, 1, 1, 1, '{}', 4),
(58, 11, 'country_id', 'text', 'Country Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(59, 11, 'detail', 'text', 'Detalle', 0, 1, 1, 1, 1, 1, '{}', 5),
(60, 11, 'status', 'checkbox', 'Estado', 1, 1, 1, 1, 1, 1, '{\"on\":\"Activo\",\"off\":\"Inactivo\",\"checked\":true}', 6),
(61, 11, 'created_at', 'timestamp', 'Creado', 0, 1, 1, 1, 0, 0, '{}', 7),
(62, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(63, 11, 'deleted_at', 'timestamp', 'Deleted At', 0, 0, 0, 0, 0, 0, '{}', 9),
(64, 11, 'city_belongsto_country_relationship', 'relationship', 'País', 1, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Country\",\"table\":\"countries\",\"type\":\"belongsTo\",\"column\":\"country_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"beneficiaries\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2021-06-02 17:55:30', '2021-06-02 17:55:30'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2021-06-02 17:55:30', '2021-06-02 17:55:30'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2021-06-02 17:55:31', '2021-06-02 17:55:31'),
(4, 'rubro_busines', 'rubro-busines', 'Rubro Empresa', 'Rubro Empresas', 'voyager-group', 'App\\Models\\RubroBusine', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-05-04 09:54:24', '2022-05-04 09:54:24'),
(6, 'rubro_people', 'rubro-people', 'Rubro Persona', 'Rubro Personas', 'voyager-people', 'App\\Models\\RubroPeople', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2022-05-04 09:57:07', '2022-05-04 09:57:07'),
(9, 'countries', 'countries', 'País', 'Paises', 'fa-solid fa-earth-americas', 'App\\Models\\Country', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-06-17 15:21:52', '2022-06-17 15:27:48'),
(11, 'cities', 'cities', 'Ciudad', 'Ciudades', 'fa-solid fa-city', 'App\\Models\\City', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-06-17 15:32:39', '2022-06-17 15:42:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-06-09 11:02:54', '2022-06-09 11:02:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Inicio', '', '_self', 'voyager-home', '#000000', NULL, 1, '2021-06-02 17:55:32', '2021-06-02 14:51:15', 'voyager.profile', 'null'),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, 5, 3, '2021-06-02 17:55:32', '2021-06-02 14:07:22', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, 11, 1, '2021-06-02 17:55:32', '2021-06-02 14:08:02', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 11, 2, '2021-06-02 17:55:32', '2021-06-02 14:08:05', 'voyager.roles.index', NULL),
(5, 1, 'Herramientas', '', '_self', 'voyager-tools', '#000000', NULL, 12, '2021-06-02 17:55:32', '2022-05-23 11:35:10', NULL, ''),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2021-06-02 17:55:33', '2021-06-02 14:07:22', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2021-06-02 17:55:33', '2021-06-02 14:07:22', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 4, '2021-06-02 17:55:33', '2021-06-02 14:07:22', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 5, '2021-06-02 17:55:33', '2021-06-02 14:07:23', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, 5, 6, '2021-06-02 17:55:33', '2021-06-02 14:07:25', 'voyager.settings.index', NULL),
(11, 1, 'Seguridad', '', '_self', 'voyager-lock', '#000000', NULL, 11, '2021-06-02 14:07:53', '2022-05-23 11:35:10', NULL, ''),
(12, 1, 'Limpiar cache', '', '_self', 'voyager-refresh', '#000000', 5, 7, '2021-06-25 18:03:59', '2022-05-16 11:53:06', 'clear.cache', NULL),
(13, 1, 'Rubro Empresas', '', '_self', 'voyager-group', NULL, 15, 4, '2022-05-04 09:54:24', '2022-06-17 15:28:14', 'voyager.rubro-busines.index', NULL),
(14, 1, 'Rubro Personas', '', '_self', 'voyager-people', NULL, 15, 3, '2022-05-04 09:57:07', '2022-06-17 15:42:53', 'voyager.rubro-people.index', NULL),
(15, 1, 'Parametros', '', '_self', 'voyager-params', '#000000', NULL, 10, '2022-05-04 09:57:46', '2022-05-23 11:35:10', NULL, ''),
(16, 1, 'Trabajadores', '', '_self', 'fa-solid fa-person-digging', '#000000', 15, 6, '2022-05-04 11:30:41', '2022-06-17 15:28:14', 'people.index', 'null'),
(17, 1, 'Empresas', '', '_self', 'fa-solid fa-building', '#000000', 15, 5, '2022-05-04 21:05:07', '2022-06-17 15:28:14', 'busines.index', 'null'),
(18, 1, 'Perfil', '', '_self', 'fa-solid fa-user-gear', '#000000', NULL, 3, '2022-05-09 11:47:52', '2022-06-02 09:39:51', 'people-perfil-experience.index', 'null'),
(19, 1, 'Perfil', '', '_self', 'fa-solid fa-building', '#000000', NULL, 6, '2022-05-10 05:36:03', '2022-06-01 16:14:38', 'busines.perfil-view', 'null'),
(20, 1, 'Buscar Trabajadores', '', '_self', 'fa-solid fa-magnifying-glass', '#000000', NULL, 5, '2022-05-12 10:14:27', '2022-06-02 09:27:23', 'search-work.index', 'null'),
(21, 1, 'Bandeja', '', '_self', 'voyager-mail', '#000000', NULL, 4, '2022-05-15 17:57:11', '2022-05-31 22:36:50', 'message-busine.bandeja', 'null'),
(22, 1, 'Bandeja', '', '_self', 'voyager-mail', '#000000', NULL, 2, '2022-05-15 17:57:45', '2022-05-31 22:36:01', 'message-people.bandeja', 'null'),
(23, 1, 'Perfil', '', '_self', 'fa-solid fa-user-gear', '#000000', NULL, 9, '2022-05-16 11:52:49', '2022-06-02 09:40:34', 'beneficiary.perfil-view', 'null'),
(24, 1, 'Buscar Empresa', '', '_self', 'fa-solid fa-magnifying-glass', '#000000', NULL, 8, '2022-05-16 12:45:21', '2022-06-02 09:26:37', 'search-busine.index', 'null'),
(25, 1, 'Bandeja', '', '_self', 'voyager-mail', '#000000', NULL, 7, '2022-05-23 11:34:58', '2022-05-31 22:38:12', 'message-beneficiary.bandeja', 'null'),
(27, 1, 'Paises', '', '_self', 'fa-solid fa-earth-americas', NULL, 15, 1, '2022-06-17 15:21:52', '2022-06-17 15:28:11', 'voyager.countries.index', NULL),
(29, 1, 'Ciudades', '', '_self', 'fa-solid fa-city', NULL, 15, 2, '2022-06-17 15:32:39', '2022-06-17 15:42:53', 'voyager.cities.index', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_busines`
--

CREATE TABLE `message_busines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `busine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rubro_busine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `beneficiary_id` bigint(20) UNSIGNED DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` datetime DEFAULT NULL,
  `date_view` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 2,
  `star` smallint(6) NOT NULL DEFAULT 0,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `message_busines`
--

INSERT INTO `message_busines` (`id`, `busine_id`, `rubro_busine_id`, `beneficiary_id`, `detail`, `view`, `date_view`, `status`, `star`, `comment`, `star_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Necesito su servicio', NULL, NULL, 2, 0, NULL, NULL, '2022-06-16 23:17:48', '2022-06-16 23:17:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_people`
--

CREATE TABLE `message_people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `people_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rubro_people_id` bigint(20) UNSIGNED DEFAULT NULL,
  `busine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rubro_busine_id` bigint(20) UNSIGNED DEFAULT NULL,
  `imoney` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fmoney` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` datetime DEFAULT NULL,
  `date_view` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 2,
  `star` smallint(6) NOT NULL DEFAULT 0,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `message_people`
--

INSERT INTO `message_people` (`id`, `people_id`, `rubro_people_id`, `busine_id`, `rubro_busine_id`, `imoney`, `fmoney`, `detail`, `view`, `date_view`, `status`, `star`, `comment`, `star_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 1, 1, '2000', '3000', 'Busco supervisor Con moto y licencia', '2022-06-13 19:22:04', NULL, 1, 0, NULL, NULL, '2022-06-13 19:20:59', '2022-06-13 19:22:04', NULL),
(2, 5, 2, 2, 1, '100.00', '20.000', 'Porfavor contactarse', NULL, NULL, 0, 0, NULL, NULL, '2022-06-16 23:02:04', '2022-06-16 23:03:43', '2022-06-16 23:03:43'),
(3, 5, 2, 3, 1, '100', '200', 'Contáctate', NULL, NULL, 2, 0, NULL, NULL, '2022-06-16 23:10:28', '2022-06-16 23:10:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2022_05_04_094324_create_rubro_busines_table', 1),
(25, '2022_05_04_094339_create_rubro_people_table', 1),
(26, '2022_05_04_095953_create_busines_table', 1),
(27, '2022_05_04_100319_create_people_table', 1),
(28, '2022_05_04_200608_create_beneficiaries_table', 1),
(29, '2022_05_09_111224_create_people_experiences_table', 1),
(30, '2022_05_09_151022_create_people_requirements_table', 1),
(31, '2022_05_10_051043_create_busine_requirements_table', 1),
(32, '2022_05_15_155316_create_message_people_table', 1),
(33, '2022_05_16_134856_create_message_busines_table', 1),
(39, '2022_05_04_094340_create_departments_table', 2),
(40, '2022_05_04_094341_create_cities_table', 2),
(41, '2022_05_09_111222_create_type_models_table', 2),
(42, '2022_06_17_144829_update_busine_table', 2),
(43, '2022_06_17_144854_update_people_table', 2),
(44, '2022_06_17_144940_update_beneficiary_table', 2),
(45, '2022_06_25_020546_update_expe_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people`
--

CREATE TABLE `people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` smallint(6) DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `people`
--

INSERT INTO `people` (`id`, `user_id`, `ci`, `first_name`, `last_name`, `birth_date`, `email`, `phone1`, `phone2`, `address`, `city`, `sex`, `weight`, `height`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`, `city_id`) VALUES
(1, 2, '1905208', 'Jorge', 'Arteaga', '1989-01-15', 'jorgearteaga8936@gmail.com', '75501433', NULL, 'Macororó V', NULL, 1, NULL, NULL, NULL, 1, '2022-06-10 19:09:23', '2022-06-10 19:09:23', NULL, NULL),
(2, 3, '1918803013', 'Carlos Alfredo', 'Arteaga Carvalho', '1990-05-17', 'alfredoarteagacarvalho@gmail.com', '69154634', NULL, 'gral davo terrazas', NULL, 1, NULL, NULL, NULL, 1, '2022-06-10 22:42:42', '2022-06-10 22:42:42', NULL, NULL),
(3, 6, '5414096', 'Luis Alberto', 'Antequera Soruco', '1980-07-15', 'antequera90@hotmail', '78096063', NULL, 'Urbanización totai, calle Sofía Rodríguez # 4511', NULL, 1, NULL, NULL, NULL, 1, '2022-06-13 19:17:33', '2022-06-13 19:17:33', NULL, NULL),
(4, 9, '9016882 scz', 'Danner Bladimir', 'Laveran Poorí', '2022-06-15', 'bladimirdanner@gmail.com', '62152024', NULL, '3er anillo externo avenida alemana', NULL, 1, NULL, NULL, NULL, 1, '2022-06-15 20:39:21', '2022-06-15 20:39:21', NULL, NULL),
(5, 10, '74672894', 'Juan', 'Peña iriarte', '1995-06-16', 'juan@gmail.com', '67492857', NULL, 'Calle la Paz', NULL, 1, NULL, NULL, NULL, 1, '2022-06-16 22:30:54', '2022-06-16 22:30:54', NULL, NULL),
(6, 16, 'LicnuUoaVfTYGC', 'QFPhmTqKCliXp', 'QaCYlmkJTLtZGd', '0000-00-00', 'gsusanec63e0luz9g@outlook.com', '8041826497', NULL, 'ZtCrgSzIXxUMk', NULL, 0, NULL, NULL, NULL, 1, '2022-06-18 21:24:23', '2022-06-18 21:24:23', NULL, NULL),
(7, 17, '7636702', 'José Antonio', 'Condori Salcedo', '1994-01-22', 'luispedrocondorisalcedo7@gmail.com', '63290377', NULL, 'Calle Ejercito', NULL, 1, NULL, NULL, NULL, 1, '2022-06-19 20:51:52', '2022-06-19 20:53:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people_experiences`
--

CREATE TABLE `people_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `people_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rubro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 2,
  `star` int(11) NOT NULL DEFAULT 0,
  `cant` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `typeModel_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `people_experiences`
--

INSERT INTO `people_experiences` (`id`, `people_id`, `rubro_id`, `status`, `star`, `cant`, `created_at`, `updated_at`, `deleted_at`, `typeModel_id`) VALUES
(1, 2, 4, 2, 0, 0, '2022-06-10 22:42:52', '2022-06-10 22:42:52', NULL, NULL),
(2, 3, 1, 2, 0, 0, '2022-06-13 19:18:45', '2022-06-13 19:18:45', NULL, NULL),
(3, 2, 3, 2, 0, 0, '2022-06-14 09:05:10', '2022-06-14 09:05:10', NULL, NULL),
(4, 5, 2, 2, 0, 0, '2022-06-16 22:31:51', '2022-06-16 22:31:51', NULL, NULL),
(5, 5, 3, 2, 0, 0, '2022-06-16 22:33:55', '2022-06-16 22:33:55', NULL, NULL),
(6, 7, 2, 2, 0, 0, '2022-06-19 20:57:48', '2022-06-19 20:57:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `people_requirements`
--

CREATE TABLE `people_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `people_experience_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image_ci` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_ap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spanish` smallint(6) DEFAULT NULL,
  `english` smallint(6) DEFAULT NULL,
  `frances` smallint(6) DEFAULT NULL,
  `italiano` smallint(6) DEFAULT NULL,
  `portugues` smallint(6) DEFAULT NULL,
  `aleman` smallint(6) DEFAULT NULL,
  `otro_idioma` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_lsm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_fcc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_manana` smallint(6) DEFAULT NULL,
  `t_tarde` smallint(6) DEFAULT NULL,
  `t_dia` smallint(6) DEFAULT NULL,
  `t_noche` smallint(6) DEFAULT NULL,
  `exp_jardineria` smallint(6) DEFAULT NULL,
  `exp_paisajismo` smallint(6) DEFAULT NULL,
  `exp_maquinas` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatura` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_mant_piscina` smallint(6) DEFAULT NULL,
  `trabajado_ante_donde` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medir_ph` smallint(6) DEFAULT NULL,
  `asp_piscina` smallint(6) DEFAULT NULL,
  `cant_quimico` smallint(6) DEFAULT NULL,
  `bomba_agua` smallint(6) DEFAULT NULL,
  `image_book` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curso_modelaje` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_modelaje` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `people_requirements`
--

INSERT INTO `people_requirements` (`id`, `type`, `people_experience_id`, `image_ci`, `image_ap`, `spanish`, `english`, `frances`, `italiano`, `portugues`, `aleman`, `otro_idioma`, `image_lsm`, `image_fcc`, `t_manana`, `t_tarde`, `t_dia`, `t_noche`, `exp_jardineria`, `exp_paisajismo`, `exp_maquinas`, `estatura`, `peso`, `exp_mant_piscina`, `trabajado_ante_donde`, `medir_ph`, `asp_piscina`, `cant_quimico`, `bomba_agua`, `image_book`, `curso_modelaje`, `exp_modelaje`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'jardinero', 4, 'trabajadores/jardinero/ci/June2022/f1NG4I1pzPUhGm8xdXZ41655433178.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-06-16 22:32:58', '2022-06-16 22:32:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(65, 'browse_admin', 'admin', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(66, 'browse_bread', NULL, '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(67, 'browse_database', NULL, '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(68, 'browse_media', NULL, '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(69, 'browse_compass', NULL, '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(70, 'browse_clear-cache', NULL, '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(71, 'browse_menus', 'menus', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(72, 'read_menus', 'menus', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(73, 'edit_menus', 'menus', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(74, 'add_menus', 'menus', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(75, 'delete_menus', 'menus', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(76, 'browse_roles', 'roles', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(77, 'read_roles', 'roles', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(78, 'edit_roles', 'roles', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(79, 'add_roles', 'roles', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(80, 'delete_roles', 'roles', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(81, 'browse_users', 'users', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(82, 'read_users', 'users', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(83, 'edit_users', 'users', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(84, 'add_users', 'users', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(85, 'delete_users', 'users', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(86, 'browse_settings', 'settings', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(87, 'read_settings', 'settings', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(88, 'edit_settings', 'settings', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(89, 'add_settings', 'settings', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(90, 'delete_settings', 'settings', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(91, 'browse_countries', 'countries', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(92, 'read_countries', 'countries', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(93, 'edit_countries', 'countries', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(94, 'add_countries', 'countries', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(95, 'delete_countries', 'countries', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(96, 'browse_cities', 'cities', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(97, 'read_cities', 'cities', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(98, 'edit_cities', 'cities', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(99, 'add_cities', 'cities', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(100, 'delete_cities', 'cities', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(101, 'browse_rubro_busines', 'rubro_busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(102, 'read_rubro_busines', 'rubro_busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(103, 'edit_rubro_busines', 'rubro_busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(104, 'add_rubro_busines', 'rubro_busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(105, 'delete_rubro_busines', 'rubro_busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(106, 'browse_busines', 'busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(107, 'read_busines', 'busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(108, 'edit_busines', 'busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(109, 'add_busines', 'busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(110, 'delete_busines', 'busines', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(111, 'browse_rubro_people', 'rubro_people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(112, 'read_rubro_people', 'rubro_people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(113, 'edit_rubro_people', 'rubro_people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(114, 'add_rubro_people', 'rubro_people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(115, 'delete_rubro_people', 'rubro_people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(116, 'browse_people', 'people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(117, 'read_people', 'people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(118, 'edit_people', 'people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(119, 'add_people', 'people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(120, 'delete_people', 'people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(121, 'browse_people-perfil-experience', 'people-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(122, 'edit_people-perfil-data', 'people-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(123, 'add_people-perfil-experience', 'people-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(124, 'edit_people-perfil-requirement', 'people-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(125, 'delete_people-perfil-experience', 'people-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(126, 'browse_message-people-bandeja', 'message-people-bandeja', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(127, 'browse_busines_perfil_view', 'busine-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(128, 'edit_busine-perfil-data', 'busine-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(129, 'add_busine-perfil-requirement', 'busine-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(130, 'view_busine-perfil-requirement', 'busine-perfil-experience', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(131, 'browse_message-busine-bandeja', 'message-busine-bandeja', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(132, 'browse_search-work', 'search-people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(133, 'add_message-people', 'search-people', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(134, 'browse_beneficiary-perfil-view', 'beneficiary-perfil-view', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(135, 'edit_beneficiary-perfil-data', 'beneficiary-perfil-view', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(136, 'browse_message-beneficiary-bandeja', 'message-beneficiary-bandeja', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(137, 'browse_search-busine', 'search-busine', '2022-06-17 15:50:56', '2022-06-17 15:50:56'),
(138, 'add_message-busine', 'search-busine', '2022-06-17 15:50:56', '2022-06-17 15:50:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(65, 1),
(65, 3),
(65, 4),
(65, 5),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(70, 3),
(70, 4),
(70, 5),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(121, 4),
(122, 1),
(122, 4),
(123, 1),
(123, 4),
(124, 1),
(124, 4),
(125, 1),
(125, 4),
(126, 1),
(126, 4),
(127, 1),
(127, 3),
(128, 1),
(128, 3),
(129, 1),
(129, 3),
(130, 1),
(130, 3),
(131, 1),
(131, 3),
(132, 1),
(132, 3),
(133, 1),
(133, 3),
(134, 1),
(134, 5),
(135, 1),
(135, 5),
(136, 1),
(136, 5),
(137, 1),
(137, 5),
(138, 1),
(138, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrador', '2022-06-09 11:02:54', '2022-06-09 11:02:54'),
(2, 'user', 'Usuario Normal', '2022-06-09 11:02:54', '2022-06-09 11:02:54'),
(3, 'empresa', 'Empresas', '2022-06-09 11:02:54', '2022-06-09 11:02:54'),
(4, 'trabajador', 'Trabajador', '2022-06-09 11:02:54', '2022-06-09 11:02:54'),
(5, 'beneficiario', 'Beneficiario', '2022-06-09 11:02:54', '2022-06-09 11:02:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro_busines`
--

CREATE TABLE `rubro_busines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rubro_busines`
--

INSERT INTO `rubro_busines` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Empresa de Seguridad Fisica', NULL, NULL, 1, '2022-05-04 10:33:47', '2022-05-04 10:33:47', NULL),
(2, 'Empresa de Jardineria', NULL, NULL, 1, '2022-05-04 10:34:10', '2022-05-04 10:34:10', NULL),
(3, 'Empresa de limpieza de Piscinas', NULL, NULL, 1, '2022-05-04 10:35:06', '2022-05-04 10:35:06', NULL),
(4, 'Empresa de Modelos', NULL, NULL, 1, '2022-05-04 10:35:06', '2022-05-04 10:35:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro_people`
--

CREATE TABLE `rubro_people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rubro_people`
--

INSERT INTO `rubro_people` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Guardia de Seguridad', NULL, NULL, 1, '2022-05-04 20:47:33', '2022-05-04 20:47:33', NULL),
(2, 'Jardinero', NULL, NULL, 1, '2022-05-09 14:28:45', '2022-05-09 15:36:02', NULL),
(3, 'Piscinero', NULL, NULL, 1, '2022-05-09 14:28:45', '2022-05-09 15:36:02', NULL),
(4, 'Modelos', NULL, NULL, 1, '2022-05-09 14:28:45', '2022-05-09 15:36:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Template', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Template Laravel y Voyager', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 4, 'Admin'),
(6, 'admin.title', 'Admin Title', 'TRABAJOS TOP', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'TrabajosTop.com', '', 'text', 1, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 2, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 3, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 5, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_models`
--

CREATE TABLE `type_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@admin.com', 'users/default.png', NULL, '$2y$10$BZtzkikCW8WqstMySfHlBuqiIinYMjwmNue6gLJqxDTSoRyOHBElK', NULL, '{\"locale\":\"es\"}', '2021-06-01 21:05:11', '2022-06-14 08:32:43'),
(2, 4, 'Jorge', 'jorgearteaga8936@gmail.com', 'users/default.png', NULL, '$2y$10$us5FB0VdwfmTOdxWGRujnuCjwSu2tJfFiauhVEHjGfKyUFWGmOps.', NULL, NULL, '2022-06-10 19:09:23', '2022-06-10 19:09:23'),
(3, 4, 'Carlos Alfredo', 'alfredoarteagacarvalho@gmail.com', 'users/default.png', NULL, '$2y$10$/MafYPip//0LzMhrfra.jO5.7oLtcSxNNPWP5Iipk1CFWAIh2uDHy', NULL, NULL, '2022-06-10 22:42:42', '2022-06-10 22:42:42'),
(6, 4, 'Luis Alberto', 'antequera90@hotmail', 'users/default.png', NULL, '$2y$10$LQMrIa2eaheUPwgrWna9DOKYdZdNnrQrCnLtY2F6cxYdGUw2kCee.', NULL, NULL, '2022-06-13 19:17:33', '2022-06-13 19:17:33'),
(7, 3, 'Bulldog seguridad', 'chichito@gmail.com', 'users/default.png', NULL, '$2y$10$LMCIM7Iat6.jTig8zF1r1OZs45if/0NSF236BzOmA2tZCNVIcyRRW', NULL, NULL, '2022-06-13 19:19:26', '2022-06-13 19:19:26'),
(8, 1, 'Ignacio', 'ignacio@gmail.com', 'users/default.png', NULL, '$2y$10$T03W0iKW5CVpeEDU7sYUUuQmzFsjSdFEz/aKMQWObrmi02jReqw3i', NULL, '{\"locale\":\"es\"}', '2022-06-14 08:30:51', '2022-06-14 08:30:51'),
(9, 4, 'Danner Bladimir', 'bladimirdanner@gmail.com', 'users/default.png', NULL, '$2y$10$o2cJjp7fiTh8rnlf168VlO27tQ9R9uTmbQrLUhFgmXI7T2U8AWozy', NULL, NULL, '2022-06-15 20:39:21', '2022-06-15 20:39:21'),
(10, 4, 'Juan', 'juan@gmail.com', 'users/default.png', NULL, '$2y$10$GXzRLDPNckl5/OZ0009vYuT4.t905VSBPhlI5wA3YNCBGFJGZ/Uvi', NULL, NULL, '2022-06-16 22:30:54', '2022-06-16 22:30:54'),
(11, 3, 'Seguridad', 'seguridad@gmail.com', 'users/default.png', NULL, '$2y$10$q70fvk.omowfnhnQw7e5GOqz.e4kOznAKRd4UTftjcJv2Nz7WL6wq', NULL, NULL, '2022-06-16 22:58:04', '2022-06-16 22:58:04'),
(12, 3, 'Seguridad', 'segurity@gmail.com', 'users/default.png', NULL, '$2y$10$XgOIp.AfDjmxhXVbneoNMe4LWkJtTfCvKQEAHXKl/bLg23BwLD9v.', NULL, NULL, '2022-06-16 23:07:06', '2022-06-16 23:07:06'),
(13, 5, 'Entel', 'entel@gmail.com', 'users/default.png', NULL, '$2y$10$HMr0cktZsiPQHwvT0Abi7.CqcfQiYG3THVv5ge2q8qo4ZowM9uwYy', NULL, NULL, '2022-06-16 23:15:34', '2022-06-16 23:15:34'),
(14, 3, 'Bulldog Security', 'marcospersonalacc@gmail.com', 'users/default.png', NULL, '$2y$10$JwuJoAOMjNn0fHQu0/6oS.tv499GjnoHOka1E9lgYGtcIe4kwTEpi', NULL, NULL, '2022-06-17 01:24:10', '2022-06-17 01:24:10'),
(15, 3, 'Vigila', 'vigila@gmail.com', 'users/default.png', NULL, '$2y$10$N06WJS9y5p7TMR2WSccYMuBAba26EH2w30d3Po4HNtDoxLxgkw79m', NULL, NULL, '2022-06-18 16:28:23', '2022-06-18 16:28:23'),
(16, 4, 'QFPhmTqKCliXp', 'gsusanec63e0luz9g@outlook.com', 'users/default.png', NULL, '$2y$10$IvF2kaPMtRlbQOgwkkPvyeD3HuF45/Ibsx4ovB5gBZpnRvOdTYIpe', NULL, NULL, '2022-06-18 21:24:23', '2022-06-18 21:24:23'),
(17, 4, 'José Antonio', 'luispedrocondorisalcedo7@gmail.com', 'users/default.png', NULL, '$2y$10$SBEKadiQBIbrsm3etb5P8.KDsqyckK18aw8O14CqMP.Hw54FgLNbi', NULL, '{\"locale\":\"es\"}', '2022-06-19 20:51:52', '2022-06-19 20:55:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiaries_user_id_foreign` (`user_id`),
  ADD KEY `beneficiaries_city_id_foreign` (`city_id`);

--
-- Indices de la tabla `busines`
--
ALTER TABLE `busines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `busines_nit_unique` (`nit`),
  ADD KEY `busines_rubro_id_foreign` (`rubro_id`),
  ADD KEY `busines_user_id_foreign` (`user_id`),
  ADD KEY `busines_city_id_foreign` (`city_id`);

--
-- Indices de la tabla `busine_requirements`
--
ALTER TABLE `busine_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `busine_requirements_busine_id_foreign` (`busine_id`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_department_id_foreign` (`department_id`);

--
-- Indices de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indices de la tabla `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indices de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indices de la tabla `message_busines`
--
ALTER TABLE `message_busines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_busines_busine_id_foreign` (`busine_id`),
  ADD KEY `message_busines_rubro_busine_id_foreign` (`rubro_busine_id`),
  ADD KEY `message_busines_beneficiary_id_foreign` (`beneficiary_id`);

--
-- Indices de la tabla `message_people`
--
ALTER TABLE `message_people`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_people_people_id_foreign` (`people_id`),
  ADD KEY `message_people_rubro_people_id_foreign` (`rubro_people_id`),
  ADD KEY `message_people_busine_id_foreign` (`busine_id`),
  ADD KEY `message_people_rubro_busine_id_foreign` (`rubro_busine_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `people_ci_unique` (`ci`),
  ADD KEY `people_user_id_foreign` (`user_id`),
  ADD KEY `people_city_id_foreign` (`city_id`);

--
-- Indices de la tabla `people_experiences`
--
ALTER TABLE `people_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_experiences_people_id_foreign` (`people_id`),
  ADD KEY `people_experiences_rubro_id_foreign` (`rubro_id`),
  ADD KEY `people_experiences_typemodel_id_foreign` (`typeModel_id`);

--
-- Indices de la tabla `people_requirements`
--
ALTER TABLE `people_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `people_requirements_people_experience_id_foreign` (`people_experience_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `rubro_busines`
--
ALTER TABLE `rubro_busines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubro_people`
--
ALTER TABLE `rubro_people`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indices de la tabla `type_models`
--
ALTER TABLE `type_models`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `busines`
--
ALTER TABLE `busines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `busine_requirements`
--
ALTER TABLE `busine_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `message_busines`
--
ALTER TABLE `message_busines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `message_people`
--
ALTER TABLE `message_people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `people_experiences`
--
ALTER TABLE `people_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `people_requirements`
--
ALTER TABLE `people_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rubro_busines`
--
ALTER TABLE `rubro_busines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rubro_people`
--
ALTER TABLE `rubro_people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `type_models`
--
ALTER TABLE `type_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `beneficiaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `busines`
--
ALTER TABLE `busines`
  ADD CONSTRAINT `busines_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `busines_rubro_id_foreign` FOREIGN KEY (`rubro_id`) REFERENCES `rubro_busines` (`id`),
  ADD CONSTRAINT `busines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `busine_requirements`
--
ALTER TABLE `busine_requirements`
  ADD CONSTRAINT `busine_requirements_busine_id_foreign` FOREIGN KEY (`busine_id`) REFERENCES `busines` (`id`);

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Filtros para la tabla `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `message_busines`
--
ALTER TABLE `message_busines`
  ADD CONSTRAINT `message_busines_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`),
  ADD CONSTRAINT `message_busines_busine_id_foreign` FOREIGN KEY (`busine_id`) REFERENCES `busines` (`id`),
  ADD CONSTRAINT `message_busines_rubro_busine_id_foreign` FOREIGN KEY (`rubro_busine_id`) REFERENCES `rubro_busines` (`id`);

--
-- Filtros para la tabla `message_people`
--
ALTER TABLE `message_people`
  ADD CONSTRAINT `message_people_busine_id_foreign` FOREIGN KEY (`busine_id`) REFERENCES `busines` (`id`),
  ADD CONSTRAINT `message_people_people_id_foreign` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `message_people_rubro_busine_id_foreign` FOREIGN KEY (`rubro_busine_id`) REFERENCES `rubro_busines` (`id`),
  ADD CONSTRAINT `message_people_rubro_people_id_foreign` FOREIGN KEY (`rubro_people_id`) REFERENCES `rubro_people` (`id`);

--
-- Filtros para la tabla `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `people_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `people_experiences`
--
ALTER TABLE `people_experiences`
  ADD CONSTRAINT `people_experiences_people_id_foreign` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `people_experiences_rubro_id_foreign` FOREIGN KEY (`rubro_id`) REFERENCES `rubro_people` (`id`),
  ADD CONSTRAINT `people_experiences_typemodel_id_foreign` FOREIGN KEY (`typeModel_id`) REFERENCES `type_models` (`id`);

--
-- Filtros para la tabla `people_requirements`
--
ALTER TABLE `people_requirements`
  ADD CONSTRAINT `people_requirements_people_experience_id_foreign` FOREIGN KEY (`people_experience_id`) REFERENCES `people_experiences` (`id`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
