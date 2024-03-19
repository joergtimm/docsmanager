#!/bin/bash

# Array, um die ausgewählten Ordner zu speichern
selected_folders=()

# Funktion, um das Auswahlmenü anzuzeigen
show_menu() {
    clear
    echo "Bitte wählen Sie die Ordner aus (Mehrere Auswahlmöglichkeiten mit Leerzeichen trennen):"
    options=()
    # Durchsuche alle Ordner im aktuellen Verzeichnis
    for folder in */; do
        options+=("${folder%/}")  # Entferne den "/" vom Ordnername
    done
    # Anzeige des Auswahlmenüs
    select folder in "${options[@]}" "Fertig"; do
        case $folder in
            "Fertig")
                break
                ;;
            *)
                selected_folders+=("$folder")
                ;;
        esac
    done
}

# Hauptprogramm
show_menu

# Ausgabe der ausgewählten Ordner
echo "Sie haben folgende Ordner ausgewählt:"
for selected_folder in "${selected_folders[@]}"; do
    echo "- $selected_folder"
done