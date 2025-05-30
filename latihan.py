
a=[1,2,3,4]
for x in a:
    if x < 2:
        a.append(x)
    
    else:
        a.pop()
        print(f"a={a}")

