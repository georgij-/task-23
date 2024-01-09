<nav>
  <ul>
    <li><a href="/"><strong>Aaron's Department</strong></a></li>
  </ul>
  <ul class="menu">
    <li><a href="/">Shifts</a></li>
    <li><a href="/workers">Workers</a></li>
    <li><a href="/import" role="button">Import</a></li>
    <li><a href="/create" class="grid-item" role="button">Add new shift</a></li>
  </ul>
</nav>

<style>
  @media (max-width: 768px) {
    header nav {
      flex-direction: column;
    }
    .menu {
      flex-direction: column;
      align-items: flex-start;
    }
    .menu li {
      padding-left: 0;
    }
  }
</style>