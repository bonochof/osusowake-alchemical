class AddImageToMenu < ActiveRecord::Migration[5.2]
  def change
    add_column :menus, :image, :string
  end
end
