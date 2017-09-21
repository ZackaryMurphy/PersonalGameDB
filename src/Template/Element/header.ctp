<header class="header">
    <div class="nav-container">
        <h1><?= $this->Html->link("Zack's Game Database", '/'); ?></h1>
        <nav class="nav">
            <ul>
                <li>
                    <?= $this->Html->link('Games', ['controller' => 'Games', 'action' => 'index']); ?>
                </li>
                <li>
                    <?= $this->Html->link('Consoles', ['controller' => 'Consoles', 'action' => 'index']); ?>
                </li>
                <?php if ($isAdmin): ?>
                <li>
                    <?= $this->Html->link('Log Out', ['controller' => 'Administrators', 'action' => 'logout']); ?>
                </li>
                <?php else: ?>
                <li>
                    <?= $this->Html->link('Log In', ['controller' => 'Administrators', 'action' => 'login']); ?>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
