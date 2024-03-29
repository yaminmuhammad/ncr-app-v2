USE [master]
GO
/****** Object:  Database [ncr_app]    Script Date: 31/05/2023 10:30:31 ******/
CREATE DATABASE [ncr_app]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'ncr_app', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\ncr_app.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'ncr_app_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\ncr_app_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [ncr_app] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [ncr_app].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [ncr_app] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [ncr_app] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [ncr_app] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [ncr_app] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [ncr_app] SET ARITHABORT OFF 
GO
ALTER DATABASE [ncr_app] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [ncr_app] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [ncr_app] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [ncr_app] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [ncr_app] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [ncr_app] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [ncr_app] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [ncr_app] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [ncr_app] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [ncr_app] SET  DISABLE_BROKER 
GO
ALTER DATABASE [ncr_app] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [ncr_app] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [ncr_app] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [ncr_app] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [ncr_app] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [ncr_app] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [ncr_app] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [ncr_app] SET RECOVERY FULL 
GO
ALTER DATABASE [ncr_app] SET  MULTI_USER 
GO
ALTER DATABASE [ncr_app] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [ncr_app] SET DB_CHAINING OFF 
GO
ALTER DATABASE [ncr_app] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [ncr_app] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [ncr_app] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [ncr_app] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'ncr_app', N'ON'
GO
ALTER DATABASE [ncr_app] SET QUERY_STORE = ON
GO
ALTER DATABASE [ncr_app] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [ncr_app]
GO
/****** Object:  User [prod]    Script Date: 31/05/2023 10:30:32 ******/
CREATE USER [prod] FOR LOGIN [prod] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Table [dbo].[ncr]    Script Date: 31/05/2023 10:30:32 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ncr](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [varchar](255) NULL,
	[hal] [varchar](50) NULL,
	[attn] [varchar](255) NULL,
	[frekuensi_masalah] [varchar](255) NULL,
	[problem] [varchar](555) NULL,
	[temporary_action] [varchar](255) NULL,
	[oty] [varchar](255) NULL,
	[standar] [varchar](255) NULL,
	[aktual] [varchar](255) NULL,
	[area] [varchar](255) NULL,
	[qty] [int] NULL,
	[satuan] [varchar](50) NULL,
	[departemen_tujuan] [varchar](255) NULL,
	[jenis] [varchar](50) NULL,
	[foto] [varchar](255) NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[deleted_at] [datetime] NULL,
 CONSTRAINT [PK_ncr] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 31/05/2023 10:30:32 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nomor] [int] NULL,
	[npk] [varchar](50) NULL,
	[nama] [varchar](100) NULL,
	[status] [varchar](100) NULL,
	[divisi] [varchar](100) NULL,
	[departemen] [varchar](100) NULL,
	[seksi] [varchar](100) NULL,
	[bagian] [varchar](100) NULL,
	[roles] [varchar](50) NULL,
	[email] [varchar](100) NULL,
 CONSTRAINT [PK_users] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[ncr] ON 

INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (1, N'testnama', N'Masalah', N'testattn', N'Sering', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium sapien orci, ac viverra metus vestibulum at.', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG B ', 11, N'Rak', N'MARKETING', N'NCR PROCESS', N'uhay.jpg', N'OK', CAST(N'2023-05-05T03:32:16.000' AS DateTime), CAST(N'2023-05-08T00:13:02.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (2, N'testnama', N'Potensi masalah', N'testattn', N'Pertama kali', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium sapien orci, ac viverra metus vestibulum at.', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG BC', 4, N'Pallet', N'QUALITY ASSURANCE', N'NCR PRODUCT', N'Virtual Background webinar nasional edudair.png', N'NG', CAST(N'2023-05-05T03:32:44.000' AS DateTime), CAST(N'2023-05-07T11:37:30.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (3, N'testnama', N'Masalah', N'testattn', N'Berulang', N'test problem lorem ipsum dolor sit amet', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG C FORMATION', 4, N'Unit', N'PPIC', N'NCR PRODUCT', N'Screenshot 2023-05-05 144059.png', N'OK', CAST(N'2023-05-05T07:43:40.000' AS DateTime), CAST(N'2023-05-07T11:36:16.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (4, N'testnama', N'Potensi masalah', N'testattn', N'Sering', N'lorem ipsum dolor sit amet consectetur adipiscing elit', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG D', 10, N'Pallet', N'HRD', N'NCR PROCESS', N'Engineering.jpeg', N'NG', CAST(N'2023-05-08T00:19:28.000' AS DateTime), CAST(N'2023-05-08T00:40:53.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (5, N'testnama', N'Masalah', N'testattn', N'Pertama kali', N'lorem ipsum dolor sit amet consectetur adipiscing elit v2 ', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG E', 12, N'Pallet', N'PROCESS ENGINEERING', N'NCR PROCESS', N'Petroleum.jpeg', N'OK', CAST(N'2023-05-08T00:40:12.000' AS DateTime), CAST(N'2023-05-08T00:44:11.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (6, N'testnama', N'Potensi masalah', N'testattn', N'Berulang', N'lorem ipsum dolor sit amet consectetur adipiscing elit v3', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG F', 5, N'Rak', N'SUPERVISOR SHIFT 2 & SHIFT 3', N'NCR PRODUCT', N'Tyler.jpeg', N'OK', CAST(N'2023-05-08T00:42:27.000' AS DateTime), CAST(N'2023-05-08T01:06:49.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (7, N'testnama', N'Masalah', N'testattn', N'Sering', N'lorem ipsum dolor sit amet consectetur adipiscing elit', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG F', 10, N'Unit', N'EHS', N'NCR PRODUCT', N'Tyler.jpeg', N'NG', CAST(N'2023-05-08T01:01:44.000' AS DateTime), CAST(N'2023-05-08T07:09:19.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (8, N'testnama', N'Potensi masalah', N'testattn', N'Pertama kali', N'lorem ipsum dolor sit amet consectetur adipiscing elit v5', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG G', 21, N'Pcs', N'FIN, ACC  & RISK MGT CONT', N'NCR PRODUCT', N'Petroleum.jpeg', N'NG', CAST(N'2023-05-08T13:14:23.000' AS DateTime), CAST(N'2023-05-08T13:15:12.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (9, N'testnama', N'Masalah', N'testattn', N'Berulang', N'lorem ipsum dolor sit amet consectetur adipiscing elit v6', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG J', 7, N'Rak', N'MAINTENANCE', N'NCR PRODUCT', N'download.jpeg', N'OK', CAST(N'2023-05-09T02:54:34.000' AS DateTime), CAST(N'2023-05-12T06:53:45.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (10, N'testnama', N'Potensi masalah', N'testattn', N'Sering', N'lorem ipsum dolor sit amet consectetur adipiscing elit v10', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG H', 20, N'Unit', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'NCR PRODUCT', N'Petroleum.jpeg', N'NG', CAST(N'2023-05-11T06:33:17.000' AS DateTime), CAST(N'2023-05-14T18:41:18.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (11, N'testnama', N'Masalah', N'testattn', N'Pertama kali', N'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum accumsan lobortis metus eget ultrices. Curabitur eget ullamcorper metus, in sagittis purus. Vivamus a venenatis nunc', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG J', 11, N'Pcs', N'HRD', N'NCR PRODUCT', N'download.jpeg', N'OK', CAST(N'2023-05-12T01:31:36.000' AS DateTime), CAST(N'2023-05-22T03:01:52.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (12, N'testnama', N'Potensi masalah', N'testattn', N'Berulang', N'lorem ipsum ', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG B ', 10, N'Pcs', N'EHS', N'NCR PROCESS', N'Virtual Background webinar nasional edudair.png', N'OK', CAST(N'2023-05-14T12:41:24.000' AS DateTime), CAST(N'2023-05-31T03:11:35.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (13, N'testnama', N'Masalah', N'testattn', N'Sering', N'lorem ipsum dolor sit amet consectetur adipiscing elit v12', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'GEDUNG B ', 2, N'Pcs', N'EHS', N'NCR PRODUCT', N'Tyler.jpeg', N'PENDING', CAST(N'2023-05-14T18:29:52.000' AS DateTime), CAST(N'2023-05-14T18:29:52.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (14, N'testnama', N'Potensi masalah', N'testattn', N'Pertama kali', N'lorem ipsum dolor sit amet', N'Sortir ', N'Reject 4 ', N'Tidak ada white mark ', N'White mark sisi kiri', N'GEDUNG F ', 2, N'Pallet', N'PPIC', N'NCR PROCESS', N'Virtual Background webinar nasional edudair.png', N'PENDING', CAST(N'2023-05-16T20:11:24.000' AS DateTime), CAST(N'2023-05-16T20:11:24.000' AS DateTime), NULL)
INSERT [dbo].[ncr] ([id], [nama], [hal], [attn], [frekuensi_masalah], [problem], [temporary_action], [oty], [standar], [aktual], [area], [qty], [satuan], [departemen_tujuan], [jenis], [foto], [status], [created_at], [updated_at], [deleted_at]) VALUES (15, N'WGGHJ', N'POTENSI MASALAH', N'testAttn', N'Berulang', N'lorem ipsum dolor sit amet consectetur adipiscing elit', N'Sortir', N'Reject 3 ', N'Tidak ada white mark ', N'White mark sisi kanan ', N'WH-C/WH-FG', 11, N'Unit', N'PROCESS ENGINEERING', N'NCR PROCESS', N'Screenshot 2023-05-28 173426.png', N'OK', CAST(N'2023-05-28T10:34:58.000' AS DateTime), CAST(N'2023-05-28T10:42:50.000' AS DateTime), NULL)
SET IDENTITY_INSERT [dbo].[ncr] OFF
GO
SET IDENTITY_INSERT [dbo].[users] ON 

INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (1, 3, N'396', N'TATI KRISNAWATI', N'Tetap', N'ADMINISTRATION', N'GA, IR & CSR', N'CSR', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (2, 4, N'412', N'MULAZIM', N'Tetap', N'PLANT', N'PRODUCTION 1', N'PASTING & FORMATION', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (3, 9, N'461', N'YUSUF SLAMET PELITA', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING A, MCB & INDUSTRIAL BATT', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (4, 15, N'481', N'NARSO', N'Tetap', N'PLANT', N'PPIC', N'WAREHOUSE MATERIAL & COMP', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (5, 18, N'485', N'NYONO', N'Tetap', N'ADMINISTRATION', N'PROCUREMENT', N'COMPONENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (6, 30, N'510', N'PARWADI', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING G & CHARGING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (7, 32, N'517', N'MUJIONO', N'Tetap', N'ADMINISTRATION', N'GA, IR & CSR', N'GA & SECURITY', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (8, 35, N'523', N'NUR ALI', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-1 PLATE PROCESS', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (9, 36, N'524', N'EDI SUWITO', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING G & CHARGING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (10, 42, N'546', N'MUSLIM', N'Tetap', N'PLANT', N'PRODUCTION 1', N'GRID CASTING, PUNCHING & MLR', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (11, 44, N'551', N'MUSBIKHIN', N'Tetap', N'PLANT', N'PRODUCTION 1', N'GRID CASTING, PUNCHING & MLR', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (12, 50, N'559', N'PUJIONO (B)', N'Tetap', N'ENGINEERING', N'QUALITY ASSURANCE', N'PRODUCTION QUALITY CONTROL', N'KASUBSIE', N'ADMIN', N'syafikiahmad3@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (13, 52, N'563', N'SUUBI', N'Tetap', N'PLANT', N'PPIC ', N'INV CONTROL FINISHED GOODS & DELIVERY', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (14, 56, N'569', N'LASONO', N'Tetap', N'PLANT', N'PPIC ', N'INV CONTROL FINISHED GOODS & DELIVERY', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (15, 62, N'584', N'YANTO', N'Tetap', N'PLANT', N'PRODUCTION 1', N'PASTING & FORMATION', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (16, 84, N'639', N'MASRURI', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING G & CHARGING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (17, 90, N'645', N'ADE SURYANA', N'Tetap', N'PLANT', N'PRODUCTION 1', N'PASTING & FORMATION', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (18, 95, N'656', N'HUGENG SUSENO', N'Tetap', N'FIN, ACC, MARK & MIS', N'MARKETING', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (19, 101, N'676', N'AGUS SUROTO', N'Tetap', N'PLANT', N'PRODUCTION 1', N'PASTING & FORMATION', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (20, 105, N'692', N'A.RIFAI', N'Tetap', N'ADMINISTRATION', N'GA, IR & CSR', N'GA & SECURITY', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (21, 107, N'698', N'IIM ARWISMAN', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING A, MCB & INDUSTRIAL BATT', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (22, 110, N'715', N'JOKO SUKO PIRENO', N'Tetap', N'FIN, ACC, MARK & MIS', N'MARKETING', N'MARKETING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (23, 113, N'731', N'DEDI RUHIMAT', N'Tetap', N'PLANT SERVICE', N'EHS ', N'HEALTH & SAFETY', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (24, 114, N'802', N'MEIJI UTOMO', N'Tetap', N'PLANT', N'X', N'X', N'KADIV', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (25, 115, N'811', N'AMIRKHAN BUGIS', N'Tetap', N'PLANT', N'PPIC ', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (26, 130, N'960', N'BAGUS MUDJIHARIADI', N'Tetap', N'PLANT', N'SUPERVISOR SHIFT 2 & SHIFT 3', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (27, 131, N'961', N'A.FARIHIN NIZAR', N'Tetap', N'ADMINISTRATION', N'X', N'X', N'KADIV', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (28, 132, N'962', N'KUSNADI', N'Tetap', N'FIN, ACC, MARK & MIS', N'FIN, ACC  & RISK MGT CONT', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (29, 171, N'1030', N'DUDY MULYANTO', N'Tetap', N'ENGINEERING', N'QUALITY ASSURANCE', N'PRODUCTION QUALITY CONTROL', N'KASUBSIE', N'ADMIN', N'syafikiahmad3@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (30, 203, N'1095', N'CIPTADI NUGROHO', N'Tetap', N'PLANT', N'PPIC ', N'PRODUCTION PLANNING CONTROL & INV CONTROL WIP', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (31, 204, N'1099', N'ABUB MAHBUBIE', N'Tetap', N'ENGINEERING', N'QUALITY ASSURANCE', N'X', N'KADEPT', N'ADMIN', N'syafikiahmad3@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (32, 205, N'1100', N'WISNU RAHAYUDI', N'Tetap', N'PLANT', N'PRODUCTION 2', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (33, 209, N'1139', N'FAHMI', N'Tetap', N'FIN, ACC, MARK & MIS', N'FIN, ACC  & RISK MGT CONT', N'GEN ACCOUNTING & TAX', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (34, 215, N'1257', N'RENDI WIDI NUGROHO', N'Tetap', N'FIN, ACC, MARK & MIS', N'MARKETING', N'MARKETING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (35, 223, N'1361', N'AGNES RETNONING ASTUTI', N'Tetap', N'FIN, ACC, MARK & MIS', N'FIN, ACC  & RISK MGT CONT', N'FINANCE, TREASURY & COSTING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (36, 226, N'1391', N'ETIKA AYU MINDIAPUTRI', N'Tetap', N'ADMINISTRATION', N'HRD', N'RECRUITMENT & COMPENSATION BENEFIT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (37, 228, N'1432', N'M.SHUBACHUSURUR', N'Tetap', N'ENGINEERING', N'PRODUCT ENGINEERING', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (38, 229, N'1440', N'ARIF BUDIANTO', N'Tetap', N'X', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (39, 233, N'1507', N'SOETARDI', N'Tetap', N'PLANT SERVICE', N'X', N'X', N'KADIV', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (40, 238, N'1529', N'WAHYU INDRIANTO PRAMONO', N'Tetap', N'FIN, ACC, MARK + MIS', N'X', N'X', N'KADIV', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (41, 239, N'1533', N'RANGGA TITO ANANTA PRATAMA', N'Tetap', N'PLANT', N'PRODUCTION 1', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (42, 246, N'1617', N'AHMAD ZAELANI', N'Tetap', N'PLANT SERVICE', N'EHS ', N'HEALTH & SAFETY', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (43, 247, N'1618', N'ARIF APRIANTO', N'Tetap', N'ENGINEERING', N'QUALITY ASSURANCE', N'QUALITY ASSURANCE', N'KASIE', N'ADMIN', N'syafikiahmad3@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (44, 249, N'1623', N'DANI CRISTIAN', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (45, 250, N'1624', N'NURUL FAJAR', N'Tetap', N'ADMINISTRATION', N'PROCUREMENT', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (46, 251, N'1625', N'SUGIYANTO', N'Tetap', N'PLANT SERVICE', N'EHS ', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (47, 263, N'1697', N'EVEI ADI KURNIAWAN', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-1 PLATE PROCESS', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (48, 281, N'1815', N'NOVIAN ANDRIKA', N'Tetap', N'PLANT', N'SUPERVISOR SHIFT 2 & SHIFT 3', N'SUPERVISOR SHIFT 2 ', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (49, 295, N'1942', N'NUR BUDIYANTO', N'Tetap', N'ENGINEERING', N'PROCESS ENGINEERING', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (50, 297, N'1971', N'AHMAD SYAFIQ', N'Tetap', N'ENGINEERING', N'PRODUCT ENGINEERING', N'PRODUCT DEPLOYMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (51, 300, N'2057', N'RATRI CAHYANINGSIH', N'Tetap', N'ADMINISTRATION', N'HRD', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (52, 301, N'2058', N'ADITYA ARDI NUGRAHA', N'Tetap', N'FIN, ACC, MARK & MIS', N'MIS', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (53, 312, N'2185', N'YUDA AJI PRASETYO', N'Tetap', N'PLANT', N'PPIC ', N'INV CONTROL FINISHED GOODS & DELIVERY', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (54, 318, N'2331', N'PRADIPTA FAJAR YUNIARTO', N'Tetap', N'ENGINEERING', N'PROCESS ENGINEERING', N'PROCESS ENG MCB IB & WET CHARGING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (55, 319, N'2346', N'LATIF USMAN', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-2 ASSEMBLING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (56, 323, N'2365', N'NUKKI KRISTIAN', N'Tetap', N'ENGINEERING', N'X', N'X', N'KADIV', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (57, 325, N'2441', N'WAHYU ADHANTA', N'Tetap', N'PLANT', N'PRODUCTION 1', N'PASTING & FORMATION', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (58, 332, N'2523', N'APRILIANTO CANDRA NUGROHO', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'PPM, IOT & MACHINE LEARNING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (59, 333, N'2524', N'BAYU SURYADI', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-2 ASSEMBLING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (60, 334, N'2526', N'KAUTZAR RIZKA IGAPUTRA', N'Tetap', N'X', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (61, 335, N'2535', N'DIKA PRATAMA', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING G & CHARGING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (62, 338, N'2593', N'CIPTO TIGOR PRIBADI NAINGGOLAN', N'Tetap', N'ENGINEERING', N'PROCESS ENGINEERING', N'PROCESS ENG LEAD POWDER PASTING & FORMATION', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (63, 347, N'2644', N'ERSHA NURANJARSARI', N'Tetap', N'ADMINISTRATION', N'HRD', N'PEOPLE DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (64, 348, N'2649', N'INDRI AFRIYANTI', N'Tetap', N'X', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (65, 360, N'2819', N'NONIK SAHAYA CITRA PURNAMASARI', N'Tetap', N'PLANT SERVICE', N'EHS ', N'ENVIRONMENT', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (66, 363, N'2846', N'RIZKY TOYIBAH', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'PPM, IOT & MACHINE LEARNING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (67, 367, N'2862', N'SUCIPTO HENING', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'PPM, IOT & MACHINE LEARNING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (68, 368, N'2863', N'FAHRIZAL FITRA UTAMA', N'Tetap', N'X', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'INDUSTRIAL SYSTEM DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (69, 378, N'2939', N'DIYAN LUQMAN NUR FATONI B', N'Tetap', N'ENGINEERING', N'QUALITY ASSURANCE', N'INCOMING PART, PDC & CLAIM HANDLING', N'KASIE', N'ADMIN', N'syafikiahmad3@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (70, 381, N'3012', N'AKHMAD MARDHANI', N'Tetap', N'PLANT', N'PRODUCTION 2', N'ASSEMBLING A, MCB & INDUSTRIAL BATT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (71, 382, N'3014', N'POLIN HASINTONGAN SIMANULLANG', N'Tetap', N'PLANT', N'PRODUCTION 1', N'GRID CASTING, PUNCHING & MLR', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (72, 398, N'3305', N'ARI MUSTAKIM', N'Tetap', N'ENGINEERING', N'PRODUCT ENGINEERING', N'PRODUCT DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (73, 399, N'3368', N'FREDY SEPTIAN', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-2 ASSEMBLING', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (74, 401, N'3384', N'ANDRIANA', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-1 PLATE PROCESS', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (75, 406, N'3446', N'AGATHA ANGGUN VIDYANITA', N'Tetap', N'ADMINISTRATION', N'PROCUREMENT', N'NON COMPONENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (76, 408, N'3476', N'SAUT JUMADI SITUMORANG', N'Tetap', N'PLANT', N'PPIC', N'WAREHOUSE MATERIAL & COMP', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (77, 409, N'3477', N'KRESNA BAYU AJI', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'UTILITY & SPARE PART MANAGEMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (78, 410, N'3479', N'WAHYU NUR FAUZIA', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-1 PLATE PROCESS', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (79, 413, N'3584', N'RINTA SETYO NUGROHO', N'Tetap', N'FIN, ACC, MARK & MIS', N'MIS', N'SYSTEM & DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (80, 417, N'3651', N'BAGUS PURNOMO', N'Tetap', N'ENGINEERING', N'PROCESS ENGINEERING', N'PROCESS ENG ASSEMBLING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (81, 420, N'3658', N'RAHMADIAN PRATAMA', N'Tetap', N'ENGINEERING', N'QUALITY ASSURANCE', N'PRODUCTION QUALITY CONTROL', N'KASIE', N'ADMIN', N'syafikiahmad3@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (82, 421, N'3659', N'RYANDANU ALDY YUDHISTIRA', N'Tetap', N'ENGINEERING', N'PROCESS ENGINEERING', N'PROCESS ENG PUNCHING & CASTING', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (83, 423, N'3688', N'KHANIFATTURRAHMAH', N'Tetap', N'FIN, ACC, MARK & MIS', N'FIN, ACC  & RISK MGT CONT', N'PLANNING & COST CONTROL', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (84, 425, N'3693', N'IKRAR SATRIA HARTAWAN', N'Tetap', N'PLANT SERVICE', N'MAINTENANCE', N'MAINTENANCE-1 PLATE PROCESS', N'KASUBSIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (85, 427, N'3764', N'KIRANA DYAH UTARI KUSUMAPUTRI', N'Tetap', N'ADMINISTRATION', N'PROCUREMENT', N'VENDOR DEVELOPMENT', N'KASIE', NULL, N'futarooow@gmail.com')
INSERT [dbo].[users] ([id], [nomor], [npk], [nama], [status], [divisi], [departemen], [seksi], [bagian], [roles], [email]) VALUES (86, 547, N'4210', N'AULIA FIRMANSYAH', N'Tetap', N'ADMINISTRATION', N'GA, IR & CSR', N'X', N'KADEPT', NULL, N'futarooow@gmail.com')
SET IDENTITY_INSERT [dbo].[users] OFF
GO
USE [master]
GO
ALTER DATABASE [ncr_app] SET  READ_WRITE 
GO
