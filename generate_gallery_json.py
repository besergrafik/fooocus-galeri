import os
import json

root_folder = "resimler"
extensions = (".webp", ".png", ".jpg", ".jpeg")

gallery_items = []

for category in sorted(os.listdir(root_folder)):
    category_path = os.path.join(root_folder, category)
    if os.path.isdir(category_path):
        for filename in sorted(os.listdir(category_path)):
            if filename.lower().endswith(extensions):
                item = {
                    "src": f"{category}/{filename}",
                    "srct": f"{category}/{filename}",
                    "title": filename,
                    "tags": category
                }
                gallery_items.append(item)

with open("gallery.json", "w", encoding="utf-8") as f:
    json.dump(gallery_items, f, indent=2, ensure_ascii=False)

print("✅ gallery.json oluşturuldu.")
