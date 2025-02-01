<style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .error-container {
        text-align: center;
    }

    .error-container h1 {
        font-size: 100px;
        font-weight: bold;
    }

    .error-container p {
        font-size: 20px;
    }
</style>

<div class="container">
    <div class="error-container">
        <h1 class="display-1 text-primary">404</h1>
        <p class="lead">Oops! <?= $message ?? 'The page you are looking for could' ?>  not be found.</p>
        <button type="button" onclick="window.history.back();" class="btn btn-primary">Go Back</button>
    </div>
</div>