<?php

namespace App;

class Form {
    /**
     * Contient les données du formulaire
     */
    private $data = [];

    public function __construct($data = []) {
        $this->data = $data;
    }

    /**
     * Permet de récupérer les données du formulaire
     */
    public function get($key) {
        // $this->data[$key] est en réalité $_POST[$key]
        return $this->data[$key] ?? null;
    }

    /**
     * Méthode magique qui est appellée quand on accéde à une propriété
     * inexistante ou private / protected.
     */
    public function __get($name) {
        return $this->get($name);
    }

    /**
     * Génére un input en HTML.
     *
     * Le label est optionnel et le type est text par défaut.
     */
    public function input($name, $label = null, $type = 'text') {
        // On a un label custom ou bien le name avec une majuscule
        $label = $label ?? ucfirst($name);
        // On récupére la value dans $this->data donc dans $_POST
        $value = $this->get($name);

        return "
            <label for='$name'>$label</label>
            <input type='$type' name='$name' id='$name' class='form-control' value='$value'>
        ";
    }

    /**
     * Génére un textarea en HTML.
     */
    public function textarea($name, $label = null) {
        $label = $label ?? ucfirst($name);
        $value = $this->get($name);

        return "
            <label for='$name'>$label</label>
            <textarea name='$name' id='$name' class='form-control'>$value</textarea>
        ";
    }

    /**
     * Génére un select avec des options en HTML.
     */
    public function select($name, $label = null, $options = []) {
        $label = $label ?? ucfirst($name);
        $value = $this->get($name);

        $list = '';
        foreach ($options as $key => $option) {
            // Permet de savoir si on met l'attribut selected ou pas
            $selected = ($value == $key) ? 'selected' : '';
            $list .= "<option value='$key' $selected>
                $option
            </option>";
        }

        return "
            <label for='$name'>$label</label>
            <select name='$name' id='$name' class='form-control'>
                $list
            </select>
        ";
    }

    /**
     * Permet de savoir si le formulaire est soumis.
     */
    public function isSubmit() {
        return !empty($this->data);
    }
}
