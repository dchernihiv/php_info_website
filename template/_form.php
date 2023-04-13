<!-- form page template -->

<!DOCTYPE html>
<html lang="ru">
<header>
    <meta name="description" content="heating equipment">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/form.css">
    <script>
        // Add new category of <select> in form
        function createCat() {
            if (document.querySelector('select').value == 'new') {
                const value = prompt('Введите название категории');
                if (value) {
                    const elem = document.createElement('option');
                    elem.innerHTML = value;
                    const parent = document.getElementById('cid');
                    parent.appendChild(elem);

                    let a = document.querySelector('select > option:last-child');
                    let b = document.getElementById('void');
                    parent.replaceChild(a, b);
                }
            }
        }
    </script>
</header>

<body>
    <main>
        <div class="content">
            <aside></aside>
            <section>
                <h3>Создание/редактирование статьи:</h3>
                <form method="POST" enctype="multipart/form-data">
                    <label for="id">Id статьи:</label>
                    <input id="id" type="number" name="id" value="<?= $result['id']; ?>"><br><br>

                    <label for="cid">Категория статьи:</label>
                    <select id="cid" name="cid" onchange="createCat()">

                        <?php
                        $array = array_values(array_unique($category, SORT_REGULAR));
                        for ($i = 0; $i < count($array); $i++) {
                            if ($array[$i]['cid'] !== $result['cid']) {
                                $out = '<option value="' . $array[$i]['cat_title'] . '/' . $array[$i]['cid'] . '">' . $array[$i]['cat_title'] . '</option>';
                                echo $out;
                            } else {
                                $out = '<option value="' . $result['cat_title'] . '/' . $result['cid'] . '"selected>' . $result['cat_title'] . '</option>';
                                echo $out;
                            }
                        }
                        ?>

                        <option id="void"><br></option>
                        <option id="new" value="new">Создать новую категорию...</option>
                    </select><br><br>

                    <label for="title">Title статьи:</label>
                    <input id="title" type="text" name="title" size="100" value="<?= $result['title']; ?>"><br><br>

                    <label for="url">URL статьи:</label>
                    <input id="url" type="text" name="url" size="100" value="<?= $result['url']; ?>"><br><br>

                    <label for="min_descr">Минимальное описание статьи:</label>
                    <input id="min_descr" type="text" name="min_descr" size="100" value="<?= $result['min_descr']; ?>"><br><br>

                    <label for="description">Основной текст статьи:</label>
                    <textarea id="description" name="description" cols="100" rows="15"><?= $result['description']; ?></textarea><br><br>

                    <label for="image">Загрузить рисунок:</label>
                    <input id="image" type="file" name="image" value="<?= $result['image'] ?>"><br><br>

                    <?php
                    if ($result['image'] != '') {
                        echo '<img src="/static/image/' . $result['image'] . '" alt="picture" style="width:150px;">';
                    }
                    ?>

                    <input type="submit" class="read" name="submit" value="<?= $btn ?>">
                    </fieldset>
                </form>
                <button class="btn" type="button" onclick="window.location.href='/admin'">Перейти в админ панель</button>
            </section>
        </div>
    </main>
    <footer></footer>
</body>
</html>