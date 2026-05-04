# packagez-api (dispatcherZ Backend API) 🚚

## 概要
`packagez-api` は、配車管理システム **dispatcherZ** の基幹機能を担うバックエンド API です。  
PHP フレームワーク **Laravel 13** をベースに構築されており、フロントエンド（Flutter）からのデータ要求、データベース操作、およびライセンス認証の管理を行います。

本リポジトリは、専用インストーラー [`packageZ`](https://github.com/ご自身のユーザー名/packagez) によって自動的にデプロイ・設定されることを前提として設計されています。

## ✨ 主な機能
- **配車管理ロジック**: 配送計画およびトラックのステータス管理。
- **データベース連携**: MySQL を使用した情報の永続化。
- **ライセンス認証 API**: シリアルコードと PIN コードによるアクティベーション処理。
- **RESTful サービス**: Flutter アプリケーションとのシームレスな通信。

## 🛠 技術スタック
- **Framework**: Laravel 13.x
- **Language**: PHP 8.x
- **Database**: MySQL
- **Tooling**: Composer, Artisan

## 🚀 セットアップ（インストーラー経由）
通常、本 API のセットアップは `packageZ` インストーラーによって全自動で行われます。
1. データベースの自動作成。
2. `.env` ファイルの自動生成と設定。
3. `php artisan migrate` によるテーブル構築。

## ⚙️ 手動セットアップ（開発者向け）
手動で環境を構築する場合は、以下の手順を実行してください。

1. **依存関係のインストール**
   
    ```bash
   composer install
    ```
2. 環境設定ファイルの作成

    ```Bash
    cp .env.example .env
    php artisan key:generate
    ```
3. データベース設定  
    `.env` 内の `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` を環境に合わせて編集。

4. マイグレーションの実行

    ```Bash
    php artisan migrate
    ```

### 📂 構成上の注意
本プロジェクト内の `.env` ファイルには機密情報が含まれるため、GitHub 等のパブリックリポジトリには公開しないでください。
---
Developed by Webflame (Morihiro Toshida)

Professional Web Design & Software Development based in Higashiosaka, Osaka.