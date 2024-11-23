import pandas as pd
from tkinter import Tk, filedialog, Button, Label, ttk, Frame, messagebox
from PIL import Image, ImageTk

def analisar_pecas(caminho_arquivo):
    # Ler o CSV e tratar espaços nos nomes das colunas
    df = pd.read_csv(caminho_arquivo)
    df.columns = df.columns.str.strip()  # Remove espaços extras nos nomes das colunas

    # Critérios de validação
    peso_min, peso_max = 50, 100
    tamanho_min, tamanho_max = 10, 20
    acabamento_min = 7

    motivos = []

    # Função para validar cada peça
    def validar_peca(row):
        if not (peso_min <= row['Peso (g)'] <= peso_max):
            motivos.append("Peso fora dos limites")
            return "Rejeitada"
        if not (tamanho_min <= row['Tamanho (cm)'] <= tamanho_max):
            motivos.append("Tamanho fora dos limites")
            return "Rejeitada"
        if not (row['Acabamento'] > acabamento_min):
            motivos.append("Acabamento insuficiente")
            return "Rejeitada"
        motivos.append("")
        return "Aprovada"

    df['Resultado'] = df.apply(validar_peca, axis=1)
    df['Motivo'] = motivos

    total = len(df)
    aprovadas = len(df[df['Resultado'] == "Aprovada"])
    rejeitadas = len(df[df['Resultado'] == "Rejeitada"])
    percentual_rejeitadas = (rejeitadas / total) * 100

    resultados = {
        "total": total,
        "aprovadas": aprovadas,
        "rejeitadas": rejeitadas,
        "percentual_rejeitadas": percentual_rejeitadas,
        "dataframe": df
    }
    return resultados

def selecionar_arquivo():
    caminho_arquivo = filedialog.askopenfilename(filetypes=[("Arquivos CSV", "*.csv")])
    if not caminho_arquivo:
        return

    resultados = analisar_pecas(caminho_arquivo)

    # Limpar dados existentes na tabela
    for row in tree.get_children():
        tree.delete(row)

    # Adicionar os dados analisados na tabela
    for idx, row in resultados["dataframe"].iterrows():
        tree.insert("", "end", values=(row['ID'], row['Peso (g)'], row['Tamanho (cm)'], row['Acabamento'], row['Resultado'], row['Motivo']))

    # Exibir estatísticas
    label_estatisticas['text'] = f"Total: {resultados['total']} | Aprovadas: {resultados['aprovadas']} | Rejeitadas: {resultados['rejeitadas']} ({resultados['percentual_rejeitadas']:.2f}%)"

    # Verificar alerta para mais de 20% de rejeições
    if resultados["percentual_rejeitadas"] > 20:
        messagebox.showwarning(
            "Alerta de Qualidade",
            f"Mais de 20% das peças foram rejeitadas ({resultados['percentual_rejeitadas']:.2f}%). "
            "Por favor, revise o processo!"
        )

        # Exibir peças rejeitadas
        rejeitadas = resultados["dataframe"][resultados["dataframe"]['Resultado'] == "Rejeitada"]
        lista_rejeitadas = rejeitadas.to_string(index=False)
        messagebox.showinfo("Peças Rejeitadas", f"Peças Rejeitadas:\n{lista_rejeitadas}")

def criar_interface():
    global tree, label_estatisticas

    janela = Tk()
    janela.title("Analisador de Peças")
    janela.geometry("800x600")

    # Frame para logo e título
    frame_topo = Frame(janela)
    frame_topo.pack(pady=10)

    # Logo e título lado a lado
    logo_imagem = Image.open("logo.png")  # Substitua pelo caminho correto para sua imagem
    logo_imagem = logo_imagem.resize((50, 50))  # Ajuste o tamanho conforme necessário
    logo = ImageTk.PhotoImage(logo_imagem)

    logo_label = Label(frame_topo, image=logo)
    logo_label.image = logo  # Referência para evitar garbage collection
    logo_label.pack(side="left", padx=10)

    Label(frame_topo, text="SENAI DEV EXPERIENCE - ETAPA FINAL 2024",
          font=("Arial", 16, "bold")).pack(side="left")

    # Botão para carregar base de dados
    Button(janela, text="Carregar base de dados", command=selecionar_arquivo, font=("Arial", 12)).pack(pady=10)

    # Tabela
    colunas = ("ID", "Peso (g)", "Tamanho (cm)", "Acabamento", "Resultado", "Motivo")
    tree = ttk.Treeview(janela, columns=colunas, show="headings", height=15)
    for col in colunas:
        tree.heading(col, text=col)
        tree.column(col, anchor="center", width=100)
    tree.pack(pady=10)

    # Estatísticas finais
    label_estatisticas = Label(janela, text="", font=("Arial", 12))
    label_estatisticas.pack(pady=10)

    # Iniciar interface
    janela.mainloop()

if __name__ == "__main__":
    criar_interface()
